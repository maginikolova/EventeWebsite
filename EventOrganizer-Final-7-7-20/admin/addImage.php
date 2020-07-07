<?php

include_once('../includes/connection.php');
include_once('../includes/event.php');

$event = new Event();
$events = $event->fetch_all();

//echo md5('password');
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


    <!-- Custom CSS -->
 

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
<?php 
    
    
        $name=htmlspecialchars($_GET['eventTitle']);
   
	if(isset($_POST['btn-add']))
	{
        $eventId =  htmlspecialchars($_GET['edit_id']);
   
		$images=$_FILES['profile']['name'];
		$tmp_dir=$_FILES['profile']['tmp_name'];
		$imageSize=$_FILES['profile']['size'];

		$upload_dir='uploads/';
		$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
		$valid_extensions=array('jpeg', 'jpg', 'png', 'gif', 'pdf');
		$picProfile=rand(1000, 1000000).".".$imgExt;
		move_uploaded_file($tmp_dir, $upload_dir.$picProfile);
        $stmt=$db_conn->prepare('INSERT INTO galery(id, username, picProfile) VALUES (:id, :uname, :upic)');
        $stmt->bindParam(':id', $eventId);
		$stmt->bindParam(':uname', $name);
		$stmt->bindParam(':upic', $picProfile);
		if($stmt->execute())
		{
			?>
			<script>
				alert("new record successul");
				window.location.href=('galery.php');
			</script>
		<?php
		}else 

		{
			?>
			<script>
				alert("Error");
				window.location.href=('addImage.php');
			</script>
		<?php
		}

	}
?>


<!-- form insert -->
<div class="container">
		<div class="add-form">
			<h1 class="text-center">Please insert an image</h1>
			<form method="post" enctype="multipart/form-data">
				<label>Event title: <?php echo $name; ?></label><br>
				<label>Event image:</label>
				<input type="file" name="profile" class="form-control" required="" accept="*/image">
				<button type="submit" name="btn-add">Add New </button>
				
			</form>
		</div>
		<hr style="border-top: 2px gray solid;">
</div>	
<!-- end form insert -->
</div>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
