<!DOCTYPE html>
<html>
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
<style type="text/css">
	.edit-form img {
		width: 150px;
		height: 100px;
	}
</style>
<body>
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

<?php 
	include("../includes/config.php");
		//if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
		//{
			$title=htmlspecialchars($_GET['eventTitle']);
			$id=$_GET[ 'edit_id'];
			$stmt_eidt=$db_conn->prepare('SELECT * FROM galery WHERE id=:uid');
			$stmt_eidt->execute(array(':uid'=>$id));
			$edit_row=$stmt_eidt->fetch(PDO::FETCH_ASSOC);
			extract($edit_row);
		//}else 

		//{
		//	header("Location: galery.php");
		//}

		if(isset($_POST['btn-save']))
		{
				$images=$_FILES['profile']['name'];
				$tmp_dir=$_FILES['profile']['tmp_name'];
				$imageSize=$_FILES['profile']['size'];

				$title = htmlspecialchars($_GET['eventTitle']);
				$upload_dir='uploads/';
				$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
				$valid_extensions=array('jpeg', 'jpg', 'png', 'gif', 'pdf');
				$picProfile=rand(1000, 1000000).".".$imgExt;
				unlink($upload_dir.$edit_row['picProfile']);
				move_uploaded_file($tmp_dir, $upload_dir.$picProfile);
				$stmt=$db_conn->prepare('UPDATE galery SET username=:uname, picProfile=:uprofile WHERE id=:uid');
				$stmt->bindParam(':uname', $title);
				$stmt->bindParam(':uprofile', $picProfile);
				$stmt->bindParam(':uid', $id);
				if($stmt->execute())
				{
					?>
					<script type="text/javascript">
						alert('Successfully Update');
						window.location.href="galery.php";
					</script>
					<?php 
				}else 

				?>
				<script type="text/javascript">
					alert('Error while update data and iamge');
					window.location.href="galery.php";
				</script>
				<?php 

			}
	
?>

<!-- form insert -->
	<div class="container">
		<div class="edit-form">
			<h1 class="text-center">Edit form </h1>
			<form method="post" enctype="multipart/form-data">
				<label>Event title: <?php echo $title; ?></label><br>
				<label>Event image</label><br>
				<img src="uploads/<?php echo $picProfile; ?>" class="img-rounded">
				<input type="file" name="profile" class="form-control" required="" accept="*/image">
				<button type="submit" name="btn-save">Update </button>
				
			</form>
		</div>
		<hr style="border-top: 2px gray solid;">
	</div>	
<!-- end form insert -->
</div>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>