<!-- TO BE REMOVED!! -->

<?php

include_once('../includes/connection.php');
include_once('../includes/article.php');

$article = new Article();
//has the user speicified an id?
if(isset($_GET['id'])){
	//display artcle
	$id = $_GET['id'];
	$data = $article->fetch_data($id);

	?>

	<html>
		<?php
			include_once('../partials/head.html');
		?>
		<body>
			<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
	  			<a class="navbar-brand" href="../index.php">Auto Nexus</a>
	 			<form class="form-inline">
	    			<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
	    			<!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">GO</button> -->
	  			</form>
			</nav>
			<div class="container">
				<br><br>
				<div class="overall">
					<div class="jumbotron">
						<h1> <?php echo $data['article_title']; ?> </h1>
						<p><small class="article-date"> <?php echo date('l jS', $data['article_timestamp']);  ?> </small></p>
						<br><br>
						<p> <?php echo $data['article_content']; ?></p>
						<br><br>
						<a class="btn btn-light" href="../index.php">&larr; Go Back</a>

					</div>
				</div>
			</div>
			<?php
				include_once('../partials/dependencies.html');
			?>
		</body>
	</html>

	<?php
}else{
	//get back to home page
	header('Location: index.php');
	exit();
}


?>
