<!DOCTYPE html>
<html>
<head>
	<title>Workflow Hunt</title>

	<!-- Custom Font -->
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet"> 

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css" integrity="sha384-2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">

	<!-- Custom CSS-->
	<link rel="stylesheet" href="<?php print base_url();?>assets/css/main.css">
</head>
<body>
	<div class="container results-container">
		<div class="row">
			<div class="col-lg-1 col-xl-1 text-xs-center text-lg-right">
				<a href="<?php print base_url();?>index.php/web/index">
					<img src="<?php print base_url();?>assets/img/logo.png" class="results-logo">
				</a>
			</div>
			<!-- .col-lg-2 .col-xl-2 .text-xs-center .text-lg-right -->
			<div class="col-lg-11 col-xl-11">
				<form action="<?php print base_url();?>index.php/web/results/" method="GET">
					<div class="input-group">
						<input type="text" class="form-control results-input-search" name="query" value="<?php print $query; ?>">
						<span class="input-group-btn">
					        <button class="btn btn-primary results-btn-search" type="submit">
					        	<span class="fa fa-search"> </span>
					        </button>
					        <!-- .results-btn-search -->
					    </span>
					    <!-- .input-group-btn -->
					</div>
					<!-- .input-group -->

					<div>
						<?php 
							if($method == "semantics")
							{
						?>
							<a href="<?php print base_url();?>index.php/web/results/?query=<?php print urlencode($query); ?>" class="results-tab">Keyword</a>
							<a href="<?php print base_url();?>index.php/web/results/?query=<?php print urlencode($query); ?>&method=semantics" class="results-tab-active">Semantics</a>
						<?php
							}
							else
							{ 
						?>
							<a href="<?php print base_url();?>index.php/web/results/?query=<?php print urlencode($query); ?>" class="results-tab-active">Keyword</a>
							<a href="<?php print base_url();?>index.php/web/results/?query=<?php print urlencode($query); ?>&method=semantics" class="results-tab">Semantics</a>
						<?php 
							}
						?>
					</div>
				</form>
				<!-- form -->
			</div>
			<!-- .col-lg-10 .col-xl-10 -->
		</div>
		<!-- .row -->
		<hr>
		<div class="row">
			<div class="col-lg-7 col-xl-7 offset-lg-1 offset-xl-1">
				<?php 	
					if($status == 'BAD')
					{
				?>
					<div class="results-not-found">
						<p>
							Your search - <strong><?php print $query; ?></strong> - 
							did not match any workflow.
						</p>
						<p>Suggestions:</p>
						<ul>
							<li>Ensure all words are spelled correctly.</li>
							<li>Try using different words or synonyms.</li>
							<li>Try using more general keywords.</li>
							<li>Make your queries as concise as possible.</li>
						</ul>
						<!-- ul -->
						<a target="_blank" href="<?php print base_url().'index.php/web/create_comparison?query='.$query; ?>">Compare Results</a>
					</div>
					<!-- .results-not-found -->
				<?php 	
					}
					else
					{
				?>
					<div class="results-found">
						<p>
							<?php print $total; ?> Results - 
							<a target="_blank" href="<?php print base_url().'index.php/web/create_comparison?query='.$query; ?>">Compare Results</a>
						</p>
						<div class="results-content">
							<?php
								foreach ($results as $workflow) 
								{
							?>
								<div class="results-workflow">
									<a href="http://www.myexperiment.org/workflows/<?php print $workflow['_id'];?>" class="results-workflow-title" target="_blank" rel="noopener noreferrer">
										<?php print $workflow['_source']['title'];?>
									</a>
									<div class="results-workflow-url">
										http://www.myexperiment.org/workflows/<?php print $workflow['_id'];?>
									</div>
									<div class="results-workflow-description">

										<?php print character_limiter($workflow['_source']['description'], 150);?>
									</div>
									<div class="results-workflow-wfms">
										Workflow Management System: <strong><?php print $workflow['_source']['swms'];?></strong>
									</div>
									<?php 
										if($method == "semantics")
										{
									?>
									<div class="results-semantic-annotations">
										<strong> Semantic annotations: </strong>
										<span>
											<a target="_blank" href="<?php print base_url().'index.php/web/workflow?id='.$workflow['_id']; ?>">
												READ MORE		
											</a>
									</div>
									<!-- .results-semantic-annotations -->
									<?php
										}
									?>
								</div>
								<!-- .results-workflow -->
							<?php
								}
							?>
						</div>
						<!-- .results-content -->
						<nav aria-label="..." class="text-xs-center">
							<ul class="pagination pagination-sm">
								<?php print $pagination->create_links(); ?>
							</ul>
							<!-- ul -->
						</nav>
						<!-- nav -->
					</div>
					<!-- .results-found -->
				<?php 	
					}
				?>
			</div>
			<!-- .col-lg-7 .col-xl-7 .offset-lg-1 .offset-xl-1 -->
		</div>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</body>
</html>