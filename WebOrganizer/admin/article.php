<?php
require_once('../includes/connection.php');
?>

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
	 <!-- Navigation -->
	<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
 		<a class="navbar-brand" href="../index.php">Event Organizer</a>
 		
	 		<ul class="nav">
				
				<li class="nav-item">
					<a class="nav-link " href="calendar.php">Calendar</a>
				</li>
				<li class="nav-item">
				    <a class="nav-link " href="admin.php">Log In</a>
				</li>
				<li class="nav-item">
				    <a class="nav-link " href="register.php">Sign Up</a>
				</li>
			</ul>	
	</nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Title Event</h1>
                <p class="lead">About the event</p>
         
            </div>
			
        </div>

    </div>

</body>

</html>
