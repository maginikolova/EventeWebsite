<?php
session_start();

include_once('../includes/connection.php');
include_once('../includes/article.php');

$article = new Article();

// check if user is logged in
if(isset($_SESSION['logged_in'])) {

	// get all articles
	$articles = $article->fetch_all();

	// del functionality
	if (isset($_GET['id'])){
		$id = $_GET['id'];

		$query = $pdo->prepare('DELETE FROM articles WHERE article_id = ?');
		$query->bindValue(1, $id);

		$query->execute();
		header('Location: admin.php');
	}

	// display admin page
	?>
	<html>
		<?php
			include_once('../partials/head.html');
		?> 
		<body>
	
		<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
 			<ul class="nav">
			  <li class="nav-item">
			    <a class="nav-link " href="logout.php">Log Out</a>
			  </li>
			</ul>
  			<a class="navbar-brand" href="../index.php">Auto Nexus</a>
 			<form class="form-inline">
    			<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    			<!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">GO</button> -->
  			</form>
		</nav>	
			<div class="container">
				<form action="admin.php" method="get">
					<br><br>
					<label for="inputState">Select Article</label>
					<select name="id" id="inputState" class="form-control">
						<?php foreach ($articles as $article) {  ?>
						
							<option value="<?php echo $article['article_id']; ?>"> 
								<?php echo $article['article_title']; ?>
							</option>

				    	<?php } ?>
			    	</select>

			    	<input class="btn btn-light" type="submit" value="Delete" autocomplete="off" />
				</form>

			</div>
			<?php
				include_once('../partials/dependencies.html');
			?> 
		</body>
	</html>
	<?php
} else {
	// form validation
	if(isset($_POST['username'], $_POST['password'])) {

		$username = $_POST['username'];
		$password = md5($_POST['password']);

		//is data empty
		if (empty($username) or empty($password)){
			$error = 'All fields required'; 	
		} else {
			$query = $pdo->prepare("SELECT * FROM users WHERE user_name = ? AND user_password  = ?");
			$query->bindValue(1, $username);
			$query->bindValue(2, $password);

			$query->execute();

			$num = $query->rowCount();

			if ($num == 1){
				//correct login data
				$_SESSION['logged_in'] = true;
				header('Location: admin.php');
				exit();
			} else {
				//incorrect data
				$error = 'Incorrect login data';
			}
		}
		
	}
	// display login page
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
				<?php if (isset($error)) { ?>

					<div class="alert alert-danger" role="alert">
 						<?php echo $error; ?>
					</div>
					
				<?php } ?>

				<form action="admin.php" method="post" autocomplete="off">

					<div class="form-group row">
				    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
				    <div class="col-sm-10">
				      <input type="text" name="username" class="form-control" id="staticEmail" placeholder="email@example.com">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
				    <div class="col-sm-10">
				      <input name="password" type="password" class="form-control" id="inputPassword" placeholder="Password">
				    </div>
				  </div>

					<input class="btn btn-light" type="submit" value="Login" autocomplete="off" />
				</form>
			</div>
			<?php
				include_once('../partials/dependencies.html');
			?> 
		</body>
	</html>
	<?php
}
?> 