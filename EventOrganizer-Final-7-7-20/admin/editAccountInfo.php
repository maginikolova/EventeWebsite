<?php
session_start();
include_once('../includes/connection.php');

if(!isset($_SESSION['user_login'])){
  header("location: ../index.php"); // proverka dali user-a ima pravo da e v tazi stranica
}

$id = $_SESSION['user_login'];
$sql = 'SELECT * FROM users WHERE user_id=:id';
$statement = $pdo->prepare($sql);
$statement->execute([':id' => $id ]);

$result = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['type']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['username'])) {
  $type = $_POST['type'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $username = $_POST['username'];

  // if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
  //   $message = "Please enter a valid email address";
  // } else if(strlen($password) < 6){
  //   $message = "Please enter a valid password at least 6 symbols";
  // }else if(strlen($username) < 1){
  //   $message = "Please enter a valid username at least 1 symbol";
  // }else{

  $sql = 'UPDATE users SET type=:type, email=:email, password=:password, username=:username WHERE user_id=:id';
  $newpassword = password_hash($password, PASSWORD_DEFAULT);
  $statement = $pdo->prepare($sql);
  if ($statement->execute([':type' => $type, ':email' => $email, ':id' => $id,':password' => $newpassword, ':username' => $username])) {
    header( "refresh:1; url=editAccountInfo.php" );
    $message="Updated succesfully";

  }else{
    header( "refresh:1; url=editAccountInfo.php" );
    $message ="Something went wrong";

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
     <div class="container"><br>
      
      <h3> Edit User Settings</h3>
      <!-- <p style="text-align: left;">Welcome <?= $result->username; ?></p> -->
      <p style="text-align: left; text-indent: -7px;overflow-x: hidden;">
      <?=
      $usertype = $result->type;
      if($usertype == 1){
              echo ("Your account type is: CLIENT");
            }else if($usertype == 2){
              echo ("Your account type is: ORGANIZER");
            } else{
              echo ("Your account type is: ADMINISTRATOR");
            }
      ?>
      </p>
      <br><br>

        
    <form  method="post" autocomplete="off">

          <div class="form-group row">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
              <input value="<?= $result->username; ?>" type="text" name="username" id="username" class="form-control">
            </div>
          </div>
       
           <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input value="<?= $result->email; ?>" type="text" name="email" id="email" class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input name="password" type="password" class="form-control" id="password" placeholder="Password">
            </div>
          </div>

          <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="exampleFormControlSelect1">Account Type</label>
                 <div class="col-sm-10">
                  <select name="type" class="form-control" id="exampleFormControlSelect1">
                  <option value="1">Client</option>
                  <option value="2">Organizer</option>
                  </select>
                </div>
          </div>

          <div class="form-group row">
          <input class="btn btn-primary" type="submit" name="btn_edit" value="Update" autocomplete="off" />

        </div>
        <?php if(!empty($message)): ?>
          <div class="alert alert-success">
            <?= $message; ?>
          </div>   
        <?php endif; ?>

        </div>

    </form>
</div>
</body>
</html>