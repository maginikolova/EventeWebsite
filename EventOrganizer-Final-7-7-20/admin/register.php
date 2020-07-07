<?php
include_once ('../includes/connection.php');


if(isset($_REQUEST['btn_register'])) {

  $username = strip_tags($_REQUEST['txt_username']);
  $email = strip_tags($_REQUEST['txt_email']);
  $password = strip_tags($_REQUEST['txt_password']);
  $type = strip_tags($_REQUEST['txt_acc_type']);

  if(empty($username)){
    $errorMsg[] = "Please enter username";
  } 
  else if(empty($email)){
    $errorMsg[] = "Please enter email";
  }  
  //else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
   // $errorMsg[] = "Please enter a valid email address";
 // } 
  else if(empty($password)){
    $errorMsg[] = "Please enter password";
  }  
  else if(strlen($password) < 6){
    $errorMsg[] = "Please enter a valid password at least 6 symbols";
  }
  else{
        try{
          $select_stmt=$pdo->prepare("SELECT username, email FROM users WHERE username=:uname OR email=:uemail");

          $select_stmt->execute(array(':uname'=>$username, ':uemail'=>$email));
          $row=$select_stmt->fetch(PDO::FETCH_ASSOC);

          if($row["username"]==$username){
            $errorMsg[]="Username Already exsitst";
          }
          else if($row["email"]==$email){
            $errorMsg[]="Email Already exsitst";
          } 
          else if(!isset($errorMsg)){
            $new_password = password_hash($password, PASSWORD_DEFAULT);

            $insert_stmt=$pdo->prepare("INSERT INTO users (username, email, password, type) VALUES (:uname, :uemail, :upassword, :utype)");

            if($insert_stmt->execute(array( ':uname'=>$username, ':uemail'=>$email, ':upassword'=>$new_password, ':utype'=>$type ))){

              $registerMsg="Register succesfully";
              header('Location: admin.php');

            }
          }
        }
        catch(PDOExceptions $e) {
              echo $e->getMessage();
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
                <strong> <?php echo $registerMsg; ?> </strong>
              </div>
        <?php 
          }
        ?>

        <form method="post" autocomplete="off">

          <div class="form-group row">
            <label for="staticName" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
              <input type="text" name="txt_username" class="form-control" id="staticEmail" placeholder="Username">
            </div>
          </div>

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

          <input class="btn btn-primary" type="submit" name="btn_register" value="Register" autocomplete="off" />
        </div>
        </form>
        <div>
            <p>
              Already a member? <a href="admin.php">Login</a>
            </p>
        </div>
      </div>
      <?php
        include_once('../partials/dependencies.html');
      ?> 
    </body>
  </html>






