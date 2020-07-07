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

<div class="container">
<h3><label for="inputState">Event request</label></h3>
	<!-- Modal -->

			<form class="form-horizontal" method="POST" action="addRequest.php">
			
			  <div class="modal-body">
				
				  <div class="form-group">
					<label for="title" class="col-sm-2 control-label">Title</label>
					<div class="col-sm-10">
					  <input type="text" name="title" class="form-control" id="title" placeholder="Title">
					</div>
				  </div>
				  <div class="form-group">
					<label for="color" class="col-sm-2 control-label">Color</label>
					<div class="col-sm-10">
					  <select name="color" class="form-control" id="color">
						  <option value="">Choose</option>
						  <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
						  <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
						  <option style="color:#008000;" value="#008000">&#9724; Green</option>						  
						  <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
						  <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
						  <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
						  <option style="color:#000;" value="#000">&#9724; Black</option>
						  
						</select>
					</div>
				  </div>
				  <div class="form-group">
					<label for="client" class="col-sm-2 control-label">Client username</label>
					<div class="col-sm-10">
						<input type="text" name="client" class="form-control" id="client" placeholder="Client username">
					</div>
				  </div>
				  <div class="form-group">
					<label for="organizer" class="col-sm-2 control-label">Oganizer</label>
					<div class="col-sm-10">
					  	<?php
							$query = "SELECT * FROM users where type='2'";
							echo "<select name = 'organizer' class='form-control' id='organizer'>";
							echo "<option value=''>Choose</option>";
							foreach((array)fetchAll($query) as $row)
							{
								
								echo "<option value = '{$row['username']}'";
								echo ">{$row['username']}</option>";
							}
							echo "</select>";
						?>
					</div>
				  </div>
				  <div class="form-group">
					<label for="start" class="col-sm-2 control-label">Start date</label>
					<div class="col-sm-10">
					  <input type="text" name="start" class="form-control" id="start" readonly>
					</div>
				  </div>
				  <div class="form-group">
					<label for="end" class="col-sm-2 control-label">End date</label>
					<div class="col-sm-10">
					  <input type="text" name="end" class="form-control" id="end" readonly>
					</div>
				  </div>
				  <div class="form-group">
					<label for="eventType" class="col-sm-2 control-label">Type of event</label>
					<div class="col-sm-10">
					  <select name="eventType" class="form-control" id="eventType">
						  <option value="">Choose</option>
						  <option> Private Party </option>
						  <option> Birthday party</option>
						  <option> Team building </option>						  
						  <option> Conference </option>
						  <option> Wedding </option>
						  <option> Private Party </option>
						  <option> Other </option>
					  </select>
					</div>
				  </div>
				  <div class="form-group">
					<label for="people" class="col-sm-2 control-label">Number of people</label>
					<div class="col-sm-10">
					  <input type="number" name="people" class="form-control" id="people">
					</div>
				  </div>
				  <div class="form-group">
					<label for="foodType" class="col-sm-2 control-label">Type of food</label>
					<div class="col-sm-10">
					  <select name="foodType" class="form-control" id="foodType">
						  <option value="">Choose</option>
						  <option> Menu </option>
						  <option> Catering </option>
					  </select>
					</div>
				  </div>
				  <div class="form-group">
					<label for="description" class="col-sm-2 control-label">Description</label>
					<div class="col-sm-10">
					  <input type="text" name="description" class="form-control" id="description" placeholder="Description">
					</div>
				  </div>
			  </div>
			  <div class="modal-footer">
				<button type="submit" class="btn btn-primary">Save changes</button>
			  </div>
			</form>
</div>
    <?php
			include_once('../partials/dependencies.html');
		?> 
	</body>
</html>