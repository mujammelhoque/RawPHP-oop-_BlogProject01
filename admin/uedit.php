<?php
require __DIR__ . '/../vendor/autoload.php';


use App\classes\Database;
use App\classes\Session;
$conn = new Database;

if(isset($_GET['uid'])){
  $id = $_GET['uid'];
    $editQ = "SELECT * from users where id='".$id."'and deleted is NULL";
$editQR = $conn->db->query($editQ);
$editQR = $editQR->fetch_assoc();
}
//load tweet values fo form end


//get form values start
if(isset($_POST['UpdateTweet'])){


$username = $_POST['username'];
$email = $_POST['email'];

$id = $_GET['uid'];

$insertTweet = "UPDATE `users` SET `username`='".$username."',`email`='".$email."',`deleted` = NULL  where id={$id}";
/*UPDATE `users` SET `username` = 'admina', `email` = 'admina@gmail.com', `deleted` = NULL WHERE `users`.`id` = 49;*/

echo $insertTweet;

$conn->db->query($insertTweet);
if($conn->db->affected_rows == 1){
  header("Location:index.php");
}
}

//get form values end
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>Add New Tweet</title>

    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/starter-template/"> -->

    

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">


    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="assets/css/starter-template.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
  </head>
  <body>
    
<!-- navbar start -->
<?php //require "partial/navbar.php"; ?>
<!-- navbar end -->

<div class="container">

  <div class="starter-template text-center py-5 px-3">
    <h1>welcome <?php echo Session::getSessionData("adminname") ?> : <?php echo Session::getSessionData("adminid") ?></h1>
    <h3>Edit Tweet</h3>

    <form method="POST" action="uedit.php?uid=<?php echo $id;?>" enctype="multipart/form-data">
  
  <div class="row mb-3">

    <label for="username" class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-10">
      <input value="<?php echo $editQR['username'] ?>" type="text" class="form-control" id="username" name="username">
    </div>
  </div>
  <div class="row mb-3">

    <label for="email" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input value="<?php echo $editQR['email'] ?>" type="text" class="form-control" id="email" name="email">
    </div>
  </div>


  <button type="submit" class="btn btn-primary" name="UpdateTweet"> Update</button>
</form>
  </div>
 </div>



<script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/ef16f745ed.js" crossorigin="anonymous"></script>

      
  </body>
</html>

