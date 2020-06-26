<?php
include_once('../includes/connection.php');
include_once('../includes/article.php');

session_start();

if(!isset($_SESSION['user_login'])){
	header("location: ../index.php"); // proverka dali user-a ima pravo da e v tazi stranica
}

$id = $_SESSION['user_login'];

$select_stmt = $pdo->prepare("SELECT * FROM users WHERE user_id=:uid");
$select_stmt->execute(array(":uid"=>$id));

$row=$select_stmt->fetch(PDO::FETCH_ASSOC);

	


	$article = new Article();
	// get all articles
	$articles = $article->fetch_all();

	// del functionality
	if (isset($_GET['id'])){
		$id = $_GET['id'];

		$query = $pdo->prepare('DELETE FROM articles WHERE article_id = ?');
		$query->bindValue(1, $id);

		$query->execute();
		header('Location: panel.php');
	}


	?>

	<html>
		<?php
			include_once('../partials/head.html');
		?> 
		<body>
	
		 <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    	 <a class="navbar-brand" href="../index.php">Event Organizer</a>
 			<ul class="nav">
			 <li class="nav-item">
			    <a class="nav-link " href="panel.php">Admin Panel</a>
			  </li>
			   <li class="nav-item">
			    <a class="nav-link " href="editAccountInfo.php">Settings</a>
			  </li>
			   <li class="nav-item">
			    <a class="nav-link " href="logout.php">Log Out</a>
			  </li>
			</ul>
  			
 			
		</nav>	
			<div class="container">
				<form action="panel.php" method="get">
					<br><br>

					<h1>Welcome <span style="text-transform: uppercase;"><?php echo $row['username']?></span> !</h1>

					

					<br><br>
					<h3><label for="inputState">All Events</label></h3>
					<p> Tук ще трябва да добавим календара вместо статиите и спрямо вида user да ограничаваме възможностите им за интеракция и едит на events.</p>
					<select name="id" id="inputState" class="form-control">
						<?php foreach ($articles as $article) {  ?>
						
							<option value="<?php echo $article['article_id']; ?>"> 
								<?php echo $article['article_title']; ?>
							</option>

				    	<?php } ?>
			    	</select>
			    	<br>
			    	<input class="btn btn-primary" type="submit" value="Delete" autocomplete="off" />
				</form>

			</div>
			<?php
				include_once('../partials/dependencies.html');
			?> 
		</body>
	</html>
	