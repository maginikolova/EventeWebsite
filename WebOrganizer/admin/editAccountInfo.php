<?php
session_start();
include_once('../includes/connection.php');

if(!isset($_SESSION['user_login'])){
  header("location: ../index.php"); // proverka dali user-a ima pravo da e v tazi stranica
}

$id = $_SESSION['user_login'];

$select_stmt = $pdo->prepare("SELECT * FROM users WHERE user_id=:uid");
$select_stmt->execute(array(":uid"=>$id));
$row=$select_stmt->fetch(PDO::FETCH_ASSOC);


  if(isset($_REQUEST['btn_edit'])) {

  
  $email = strip_tags($_REQUEST['txt_email']);
  $password = strip_tags($_REQUEST['txt_password']);
  $type = strip_tags($_REQUEST['txt_acc_type']);

  }
  else if(empty($email)){
    $errorMsg[] = "Please enter email";
  }  
  //else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
   // $errorMsg[] = "Please enter a valid email address";
  //} 
  else if(empty($password)){
    $errorMsg[] = "Please enter password";
  }  
  else if(strlen($password) < 6){
    $errorMsg[] = "Please enter a valid password at least 6 symbols";
  }
  else{
        
          $select_stmt=$pdo->prepare("SELECT users SET email=:uemail, password=:upassword, type=:utype WHERE user_id=:uid");

          $select_stmt->execute(array(':uemail'=>$email, ':upassword'=>$password, ':utype'=>$type));
          $row=$select_stmt->fetch(PDO::FETCH_ASSOC);

         
            $new_password = password_hash($password, PASSWORD_DEFAULT);

            $insert_stmt=$pdo->prepare("UPDATE INTO users (email, password, type) VALUES (:uemail, :upassword, :utype)");

            if($insert_stmt->execute(array(':uemail'=>$email, ':upassword'=>$new_password, ':utype'=>$type ))){

              $registerMsg="Updated succesfully";
        
       
    }
}

?>

<html>
<head>    
    <?php
			include_once('../partials/head.html');
		?> 
</head>
 
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
     <div class="container"><br>
    <h1>Welcome <span style="text-transform: uppercase;"><?php echo $row['username']?></span> !</h1>

          <h3>
          <?php 

            $usertype = $row['type'];

            if($usertype == 1){
              echo ("Your account type is: CLIENT");
            }else if($usertype == 2){
              echo ("Your account type is: ORGANIZER");
            } else{
              echo ("Your account type is: ADMINISTRATOR");
            }
          ?>
        </h3>
     	<br><br>
     	<h3> Edit User Settings</h3>
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
                <strong> <?php echo $registerMsg; ?> </strong>
              </div>
        <?php 
          }
        ?>
    <form  method="post" autocomplete="off">
       
           <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input name="txt_email" type="email" class="form-control" id="inputEmail" placeholder="Email">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input name="txt_password" type="password" class="form-control" id="inputPassword" placeholder="Password">
            </div>
          </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="exampleFormControlSelect1">Account Type</label>
                 <div class="col-sm-10">
                  <select name="txt_acc_type" class="form-control" id="exampleFormControlSelect1">
                  <option value="1">Client</option>
                  <option value="2">Organizer</option>
                  </select>
                </div>
            </div>
           <div class="form-group row">
            <input class="btn btn-primary" type="submit" name="btn_edit" value="Edit" autocomplete="off" />
        </div>
        </div>

    </form>
</div>
</body>
</html>