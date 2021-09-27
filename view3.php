<?php
require __DIR__ . '/vendor/autoload.php';
include "db.php";

use App\classes\Config;
use App\classes\Session;

$userid = Session::getSessionData("userid");
$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<?php
  


    
if(isset($_POST['userCommentBtn'])){
  $id = $_POST['id'];
$userid = Session::getSessionData("userid");
  $c =strip_tags($_POST['userComment']);
 $inQ= "INSERT INTO `comments` (`id`, `tid`, `uid`,`mid`,`Pid`, `comment`, `status`, `created`, `deleted`) VALUES (NULL, NULL, '$userid','$id', NULL,'.$c.','1', current_timestamp(), NULL)";
  /*INSERT INTO `comments` (`id`, `tid`, `uid`, `mid`, `comment`, `status`, `created`, `deleted`) VALUES (NULL, '5', '49', NULL, 'EEEEEEEEEEEE', '2', current_timestamp(), NULL);*/


  $conn->query($inQ);

  if($conn->affected_rows == 1){
    // Session::setSessionData('message',"Comment Added");
  header("Location:view3.php?id=".$id);
  }
}
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'],FILTER_VALIDATE_INT);
}
  ?>
  <?php 
     
     $qw = "SELECT mypoem.*,mypoemcata.name  FROM `mypoem` 
     inner join mypoemcata on mypoem.mpcid=mypoemcata.id
     WHERE  mypoem.id=".$id." ";
//echo $q;
     $share = $conn->query($qw);
     $info = $share->fetch_assoc();

  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title><?php echo $info['title'] ?></title>
<meta property="og:url"           content="<?php echo $url; ?>" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="<?php echo $info['title']; ?>" />
<meta property="og:description"   content="<?php echo $info['poem']; ?>" />
<meta property="og:image"         content="<?php echo Config::siteinfo()['baseurl'] ?>storyimage/<?php echo $info['image'];?>" />

    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/starter-template/"> -->

    

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    


    <!-- Favicons -->
 <!-- <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico"> -->

<meta name="theme-color" content="#7952b3">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->


    <style>
    
    </style>

    
    <!-- Custom styles for this template -->
    <link href="assets/css/starter-template.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
  </head>
<body>
<div class="container-fluid">









<!-- ******************start navbar***************** -->
<?php  include("partial/navbar.php"); ?>
<!-- ////////////////////////end navbar//////////////-->

<div class="row align-items-start mt-2">
<!-- ******************start left-sidebar***************** -->

<div class="col-md-3 col-sm-12 bg-success ">


<div class="row">
  <div class="col-12 d-none  d-md-block d-lg-block col-md-12 ">

    <?php
    if (Session::getSessionData("loggedin")) {
      include("partial/left_yoursidebar.php");
      include("partial/left_sidebar.php");
    } else {
      include("partial/left_sidebar.php");
    }
    ?>
  </div>
  <div class="col-12 col-sm-12 d-md-none d-lg-none  d-block ">

  <nav class="navbar navbar-expand-md navbar-light bg-light">
<div class="container-fluid">
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation" >
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarTogglerDemo01" class="">
    <?php
    if (Session::getSessionData("loggedin")) {

      include("partial/left_yoursidebar.php");
      include("partial/left_sidebar.php");
      include("partial/right_sidebar.php");
    } else {
      
      include("partial/left_sidebar.php");
      include("partial/right_sidebar.php");
    }
    ?>
    
</div>
</div>
</nav>
  
  </div>

</div>


</div>
    <!-- ////////////////////////end side-bar//////////////-->
    <div class="col-sm-12 col-md-6 col-lg-6">
     <?php
    
       $q = "SELECT mypoem.*,mypoemcata.name  FROM `mypoem` 
                 inner join mypoemcata on mypoem.mpcid=mypoemcata.id
                 WHERE  mypoem.id=".$id." ";
        //echo $q;
       // $q = "select * from tweets";
       $allTweet = $conn->query($q);

  
     if ($allTweet->num_rows>0) {
   while ($row = $allTweet->fetch_assoc() ) {
  echo '<div class="card mb-3" style="max-width: 640px;">
  <div class="row g-0">
   
    <div class="col-md-12">
      <div class="card-body">
        <h5 class="card-title"><pre>'.$row['title'].'</pre></h5>
        <p class="card-text"> '. $row['poem'].' </p>
        <p class="card-text"><small class="text-muted">'.$row['created'].'</small></p>
      </div>
      <div class="col-md-12">
      <img class="w-100" src="storyimage/'.$row['image'].'" alt="...">
    </div>
    </div>
  </div>
</div>
<div class="" data-href="<?php '.$url.'; ?>" data-layout="button_count" data-size="large"><h4 class="text-end"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='.$url.';" class="fb-xfbml-parse-ignore"><img style="width:50px" src="image/download.png" alt=""></a></h4></div>'
;}
     }
   
     ?>


      <?php
 if(Session::getSessionData("loggedin")){
 ?>
<h3>Comment</h3>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
<div class="mb-3 text-start">
<input type="hidden" name="id" value="<?php echo $id;  ?>">
<label for="userComment" class="form-label text-start">Write Your Comment</label>
<textarea class="form-control" name="userComment" id="userComment" rows="5" required maxlength="1000"></textarea>
</div>
<div class="col-12">
 <button type="submit" name="userCommentBtn" class="btn btn-primary">Post Comment</button>
</div>
</form>
 <?php
}
else{
?>
Please 
<a href="login.php">Login</a> or
<a href="registration.php">Register</a>
to Write Comment
<?php
}
?>

<h3>All Comment</h3>
<?php 
$ssl= "SELECT comments.*,users.username FROM comments inner join users on comments.uid=users.id where comments.mid=$id ";
$qq = $conn->query($ssl);
if ($qq->num_rows >0) {
 while($row = $qq->fetch_assoc()){
   echo '<div class="card w-100">
   <div class="card-body bg-light">
     <h5 class="card-title w-50 ">'.$row['username'].'</h5>
 
     <p class="card-text ">'.$row['comment'].'</p>
 
   </div>
 </div>';
 }
}


?>




						
					

				


					
    
    </div>
    <div class="col-3	d-none d-md-block d-lg-block bg-success">
    <?php include("partial/right_sidebar.php"); ?>
    </div>
    </div>

    <?php echo include "partial/footer.php"?>

</div>








<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>