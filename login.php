<?php

require "db.php";
require __DIR__ . '/vendor/autoload.php';
// use App\classes\Database;
// use App\classes\Login;

use App\classes\Session;
// if(Session::getSessionData("loggedin")){
//     header("Location:dashboard.php")
// }
if (Session::getmywork('regi')) {
  $mess = '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Hi!</strong> '.Session::getmywork('regi').'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

// $message = Session::getFlashData("message");
if(isset($_POST['signin'])){
    // $conn = new Database();
    
    
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $query = "select * from users where email = '".$email."' limit 1";
    //echo $query;
    $queryResult = $conn->query($query);
    if($queryResult->num_rows == 1){
        $record = $queryResult->fetch_assoc();
        
        if(password_verify($pass,$record['password'])){
            //var_dump($record); 
            Session::setSessionData("loggedin",TRUE);
            Session::setSessionData("username",$record['username']);
            Session::setSessionData("useremail",$record['email']);
            Session::setSessionData("userid",$record['id']);
            header("Location:index.php");
        }else{
          $try= '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Hi!</strong><h3>Please Try again</h3>
          <h5 class="text-end"><a href="registration.php">Click for Registration</a></h5>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
    }
}

?>
<a href=""></a>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

</head>
<body>

    <div class="container-fluid ">
    
    <?php  include("partial/navbar.php"); ?>
    <div class="mt-1"></div>
    <?php echo $mess??"" ;
    echo $try??""; ?>
 
    <form action="" class="bg-success mt-5 p-4" method="POST" enctype="multipart/form-data">
    <caption>  <h2 class="text-center">Please Login</h2></caption>
  <div class="form-group">
    <label class="text-info" for="t">email</label>
    <input type="email" name="email" class="form-control"  id="t">
  </div>
  <div class="form-group">
    <label class="text-info" for="p">password:</label>
  <input type="password" class="form-control"  name="pass" id="p">
  </div>
  
  <button type="submit" name="signin" class="btn btn-primary mt-5">Sign in</button>

    </form>
    <?php  require "partial/footer.php"; ?>
    </div>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
