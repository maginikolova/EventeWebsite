<?php

include_once('../includes/connection.php');
include_once('../includes/event.php');

session_start();
include_once('../includes/connection.php');

if(!isset($_SESSION['user_login'])){
  header("location: ../index.php"); // proverka dali user-a ima pravo da e v tazi stranica
}

$id1 = $_SESSION['user_login'];

$select_stmt1 = $pdo->prepare("SELECT * FROM users WHERE user_id=:uid");
$select_stmt1->execute(array(":uid"=>$id1));
$row1=$select_stmt1->fetch(PDO::FETCH_ASSOC);

$event = new Event();
$events = $event->fetch_all();

?>

<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
	include_once('../partials/head.html');
?> 
	<link href="css/bootstrap.css" rel="stylesheet">

	
	<!-- FullCalendar -->
	<link href='css/fullcalendar.css' rel='stylesheet' />

</head>
<body>

 <!-- Navigation -->
 <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
          <a class="navbar-brand" href="../index.php">Event Organizer</a>
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link " href="galery.php">Gallery</a>
            </li>
          <li class="nav-item">
              <a class="nav-link " href="calendar.php">Calendar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="panel.php">Requests</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="editAccountInfo.php">Settings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="logout.php">Log Out</a>
            </li>
          </ul>	
 			
		</nav>	

    <!-- Page Content -->
    <div class="container">

<!-- delete script -->
	<?php 
	include("../includes/config.php");
	if(isset($_GET['delete_id']))
	{
		$stmt_select=$db_conn->prepare('SELECT * FROM galery WHERE id=:uid');
		$stmt_select->execute(array(':uid'=>$_GET['delete_id']));
		$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
		unlink("uploads/".$imgRow['picProfile']);
		$stmt_delete=$db_conn->prepare('DELETE FROM galery WHERE id =:uid');
		$stmt_delete->bindParam(':uid', $_GET['delete_id']);
		if($stmt_delete->execute())
		{
			?>
			<script>
			alert("You are deleted one item");
			window.location.href=('galery.php');
			</script>
			<?php 
		}else 

		?>
			<script>
			alert("Can not delete item");
			window.location.href=('galery.php');
			</script>
			<?php 

	}

	?>
<!-- end delete script -->

<!-- view form -->
<div class="container">
<div class="row justify-content-center">
<?php foreach ($events as $event) { ?>
			<?php 
				$eventId = $event['id'];
				$eventTitle = $event['title'];
			?>

			<div class="card col-4" style="margin: 10px 10px; max-width: 31%;">
			  <div class="card-body">
			    <h5 class="card-title" style="color:blue;"><a class="item-title"> <?php echo $event['title']; ?> </a></h5>
			    <h6 class="card-subtitle mb-2 text-muted"><small class="item-date"> posted: <?php echo $event['start'];  ?> </small></h6> <br>
				<h6 class="card-subtitle mb-2 text-muted"><small class="item-date"> Organizer: <?php echo $event['organizer'];  ?> </small></h6><br>
				<h6 class="card-subtitle mb-2 text-muted"><small class="item-date"> Event type: <?php echo $event['eventType'];  ?> </small></h6><br>
					<div class="view-form">
						<div class="row">
							<?php 
								$sql_stm = "SELECT * FROM galery";//$event[id]
								$stmt=$db_conn->prepare($sql_stm);
								$stmt->execute();
								if($stmt->rowCount()>0)
								{
									while($row=$stmt->fetch(PDO::FETCH_ASSOC))
									{
										extract($row);
										if($row['id'] == $eventId ){
										?>
											<img src="uploads/<?php echo $row['picProfile']?>" style ="width:260px; height:260px;"><br><br>
											
											<?php 
											if(!strcmp($event['organizer'], $row1['username'])){
											?>
											<div class="col-sm-8">
														<a class="btn btn-info" href="article.php?edit_id=<?php echo $eventId?>&eventTitle=<?php echo $eventTitle;?>" title="click for edit" onlick="return confirm('Sure to edit this record')"><span class="glyphicon glyphicone-edit"></span>Edit</a>
														<a class="btn btn-danger" href="?delete_id=<?php echo $row['id']?>" title="click for delete" onclick="return confirm('Sure to delete this record?')">Delete</a>
											</div>
											<?php }?>	
								<?php 
										}
									}
								}
							?>
		
						</div>
					</div>
				 </p>
				 <?php 
					if(!strcmp($event['organizer'], $row1['username'])){
				 ?>
				 <div class="col-sm-8">
					<a href="addImage.php?edit_id=<?php echo $event['id']; ?>&eventTitle=<?php echo $eventTitle;?>" class="card-link">Add image</a>
				</div>
				<?php }?>	
			  </div>
			</div>
			<?php } ?>
			</div>


			<br><br>
		</div>
	
</div>
<!-- end view form -->
</div>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>