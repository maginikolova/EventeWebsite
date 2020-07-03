<?php

include_once('includes/connection.php');
?>

<html>
<head>
	<?php
	include_once('partials/head.html');
	?>
<style type="text/css">

html, body{
 width: 100%;
 height: 100%;
 padding: 0;
 margin: 0px;
}

slider {
 display: block;
 width: 100%;
 height: 100%;
 background-image: url(images/22.jpg);
 overflow: hidden;
 position: absolute;
 background-size: cover;
 background-position: center;
 height:93%;
}

slider > * {
 position: absolute;
 display: block;
 width: 100%;
 height: 100%;
 background: #fff;
 animation: slide 8s infinite;
 overflow: hidden;
}

slide:nth-child(1){
 left: 0%;
 animation-delay: 4s;
 background-image: url(images/1.jpg);
 background-size: cover;
 background-position: center;
}

slide:nth-child(2){
 animation-delay: 2s;
 background-image: url(images/2.jpg);
 background-size: cover;
 background-position: center;
}

slide:nth-child(3){
 animation-delay: 0s;
 background-image: url(images/3.jpg);
 background-size: cover;
 background-position: center;
}

slide p {
 font-family: Comfortaa;
 font-size: 70px;
 text-align: center;
 display: inline-block;
 width: 100%;
 margin-top: 340px;
 color: #fff;
}

@keyframes slide {
 0% { left: 100%; width: 100%; }
 5% { left: 0%; }
 25% { left: 0%; }
 30% { left: -100%; width: 100%; }
 30.0001% { left: -100%; width: 0%; }
 100% { left: 100%; width: 0%; }
}

</style>
</head>
	
	<body>

		<nav class="navbar navbar-light" style="background-color: #e3f2fd;>
			<a class="navbar-brand" href="index.php">Event Organizer</a>
	 		<ul class="nav">
				<li class="nav-item">
				    <a class="nav-link " href="admin/admin.php">Log In</a>
				</li>
				<li class="nav-item">
				    <a class="nav-link " href="admin/register.php">Sign Up</a>
				</li>
			</ul>
		</nav>
	
		<slider>
			<slide><p>PARTIES</p></slide>
			<slide><p>FESTIVALS</p></slide>
			<slide><p>SPECIAL EVENTS</p></slide>
		</slider>
		
		<?php
			include_once('partials/dependencies.html');
		?>
	</body>
</html>