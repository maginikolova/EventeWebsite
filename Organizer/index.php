<?php

include_once('includes/connection.php');
include_once('includes/event.php');

$event = new Event();
$events = $event->fetch_all();

//echo md5('password');
?>

<html>
	<?php
	include_once('partials/head.html');
	?>
	<body>

		<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
			<a class="navbar-brand" href="index.php">Event Organizer</a>
	 		<ul class="nav">

				<li class="nav-item">
					<a class="nav-link " href="admin/calendar.php">Calendar</a>
				</li>
				<li class="nav-item">
				    <a class="nav-link " href="admin/admin.php">Log In</a>
				</li>
				<li class="nav-item">
				    <a class="nav-link " href="admin/register.php">Sign Up</a>
				</li>
			</ul>
		</nav>

		<div class="container">
			<!-- <button class="btn btn-default" id="dark">DARK</button> -->
			<br><br>
			<!-- <ul class="list-group"> -->



			<div class="row justify-content-center">
<?php foreach ($events as $event) { ?>
			<div class="card col-4" style="margin: 10px 10px; max-width: 31%;">
			  <div class="card-body">
			    <h5 class="card-title"><a class="item-title" href="admin/events.php?id=<?php echo $event['id']; ?>"> <?php echo $event['title']; ?> </a></h5>
			    <h6 class="card-subtitle mb-2 text-muted"><small class="item-date"> posted: <?php echo $event['start'];  ?> </small></h6>
			    <p class="card-text"><?php echo "IMG Here"; ?> </p>
			    <a href="admin/article.php?id=<?php echo $event['people']; ?>"" class="card-link">Read More</a>
			    <a href="#" class="card-link">Another link</a>
			  </div>
			</div>
			<?php } ?>
			</div>


			<br><br>
		</div>
		<?php
			include_once('partials/dependencies.html');
		?>
	</body>
</html>