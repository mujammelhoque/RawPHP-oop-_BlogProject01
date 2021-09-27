<?php
require __DIR__ . '/vendor/autoload.php';


use App\classes\Session;
include "db.php";
if(isset($_POST['submit'])){
    
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $repass = $_POST['repass'];
    if($pass === $repass){
        $hash = password_hash($pass,PASSWORD_DEFAULT);
        $insertQuery = "insert into users values(NULL,'".$username."','".$email."','".$hash."',NULL,'1','1',NULL,NULL,NULL)";
        // echo $insertQuery;
        $conn->query($insertQuery);
        if($conn->affected_rows == 1){
            // Session::setSessionData('message',"Registration Successful!! You can login");
           
            header("Location:login.php");
            Session::setmywork('regi',"your have registered successfully");
        }
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

</head>
<body>
    <div class="container ">
    <?php  include("partial/navbar.php"); ?>
  

    <div class="row">
    <div class="col-2 "></div>
    <div class="col-8 ">
    <div class="card bg-dark mt-2">
  <div class="card-body">
    <h5 class="card-title text-center text-white">Please Register</h5>
    <form action="" class="bg-success mt-5 p-4" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label class="text-info" for="u">username</label>
    <input type="text" name="username" class="form-control"  id="u">
  </div>
  <div class="form-group">
    <label class="text-info" for="t">email</label>
    <input type="email" name="email" class="form-control"  id="t">
  </div>
  <div class="form-group">
    <label class="text-info" for="p">password:</label>
  <input type="password" class="form-control"  name="pass" id="p">
  </div>
  <div class="form-group">
    <label class="text-info" for="rp">Re-password:</label>
  <input type="password" class="form-control"  name="repass" id="rp">
  </div>
  
  <button type="submit" name="submit" class="btn btn-primary mt-5">Submit</button>

    </form>
   
  </div>
</div></div>
    <div class="col-2"></div>
    </div>
   
    
    </div>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
