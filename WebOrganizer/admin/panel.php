<?php
include_once('../includes/connection.php');
include("../includes/request.php");

session_start();

if(!isset($_SESSION['user_login'])){
	header("location: ../index.php"); // proverka dali user-a ima pravo da e v tazi stranica
}

$id = $_SESSION['user_login'];

$select_stmt = $pdo->prepare("SELECT * FROM users WHERE user_id=:uid");
$select_stmt->execute(array(":uid"=>$id));

$row=$select_stmt->fetch(PDO::FETCH_ASSOC);

//session_start(); //we need session for the log in thingy

//if($_SESSION['login']!==true){
	//header('location:login.php');
//}

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
			    <a class="nav-link " href="allevents.php">Gallery</a>
			  </li>
			 <li class="nav-item">
			    <a class="nav-link " href="calendar.php">Calendar</a>
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
					<h3><label for="inputState">All Pending Events</label></h3>
					<section class="jumbotron text-center">
						<div class="container">
							<?php
								$query = "select * from `requests`;";
								if(count((array)fetchAll($query))>0){
									foreach((array)fetchAll($query) as $row){
										?>
			
									<h1 class="jumbotron-heading"><?php echo $row['title'] ?></h1>
									<p class="lead text-muted"><?php echo $row['organizer'] ?></p>
									<p>
										<a href="accept.php?id=<?php echo $row['id'] ?>" class="btn btn-primary my-2">Accept</a>
										<a href="reject.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary my-2">Reject</a>
									</p>
									<small><i><?php echo $row['start'] ?></i></small>
									<small><i><?php echo $row['end'] ?></i></small>
									<hr>
							<?php
									}
								}else{
									echo "No Pending Requests.";
								}
							?>
						
						</div>
						
					</section>	
				</form>

			</div>
			<?php
				include_once('../partials/dependencies.html');
			?> 
		</body>
	</html>
	