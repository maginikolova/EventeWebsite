<?php
include_once('../includes/connection.php');
include_once('../includes/request.php');
session_start();

// check if user is logged in
if(isset($_SESSION['user_login'])) {
	// display admin page
	header('Location: calendar.php');
	
} 

if(isset($_REQUEST['btn_login'])) {
	
	  $username = strip_tags($_REQUEST['txt_username_email']);
	  $email = strip_tags($_REQUEST['txt_username_email']);
	  $password = strip_tags($_REQUEST['txt_password']);

	  if(empty($username)){
	    $errorMsg[] = "Please enter username";
	  } 
	  else if(empty($email)){
	    $errorMsg[] = "Please enter email";
	  }  
	  else if(empty($password)){
	    $errorMsg[] = "Please enter password";
	  }  
	  else{
	        try{	 

	        	 $select_stmt=$pdo->prepare("SELECT * FROM users WHERE username=:uname OR email=:uemail");

		         $select_stmt->execute(array(':uname'=>$username, ':uemail'=>$email));
		         $row=$select_stmt->fetch(PDO::FETCH_ASSOC);

		         if($select_stmt->rowCount() > 0){
		         	if($username==$row["username"] OR $email==$row["email"]){
		         		if(password_verify($password, $row["password"])){
		         			$_SESSION["user_login"] = $row["user_id"];
							$loginMsg= "Successfully Logged In.";
							header("Location: galery.php");
		         		}
		         		else{
		         			$errorMsg[]="Wrong Password !";
		         		}
		         	}
		         	else{
		         	$errorMsg[]="Wrong username or email !";
		         	}
		         }
		         else{
		         	$errorMsg[]="Wrong username or email !";
		         }
		    }
		    catch(PDOException $e){
		    	$e->getMessage();
		    }
		}
	}

	?>
	<html>
		<?php
			include_once('../partials/head.html');
		?> 
		<body>
				<!-- Navigation -->
				<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
			 		<a class="navbar-brand" href="../index.php">Event Organizer</a>
				 		<ul class="nav">
							<li class="nav-item">
							    <a class="nav-link " href="admin.php">Log In</a>
							</li>
							<li class="nav-item">
							    <a class="nav-link " href="register.php">Sign Up</a>
							</li>
						</ul>	
					</nav>
			<div class="container">
				<br><br>
					   <?php 
			          if (isset($errorMsg)) { 
			            foreach($errorMsg as $error){ ?>

			              <div class="alert alert-danger">
			                <strong> <?php echo $error; ?> </strong>
			              </div>

			        <?php 
			            }
			          }
			          if(isset($registerMsg)){ ?>

			              <div class="alert alert-success">
			                <strong> <?php echo $loginMsg; ?> </strong>
			              </div>
			        <?php 
			          }
			        ?>

				<form action="admin.php" method="post" autocomplete="off">

				<div class="form-group row">
				    <label for="staticEmail" class="col-sm-2 col-form-label">Username / Email</label>
				    <div class="col-sm-10">
				      <input type="text" name="txt_username_email" class="form-control" id="staticEmail" placeholder="Username">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
				    <div class="col-sm-10">
				      <input name="txt_password" type="password" class="form-control" id="inputPassword" placeholder="Password">
				    </div>
				  </div>

					<input class="btn btn-primary" name="btn_login" type="submit" value="Login" autocomplete="off" />
				</form>
				<div>
            <p>
              Don't have an account? <a href="register.php">Register</a>
            </p>
        </div>
			</div>
			<?php
				include_once('../partials/dependencies.html');
			?> 
		</body>
	</html>
