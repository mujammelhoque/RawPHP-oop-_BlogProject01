
<?php
  include "db.php";
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
 
    </style>
</head>
<body>
<div class="container-fluid">

<h2><a href="tweets.php">Post Tweets</a></h2>







<!-- ******************start navbar***************** -->
<?php  include("partial/navbar.php"); ?>
<!-- ////////////////////////end navbar//////////////-->

<div class="row align-items-start mt-2">
<!-- ******************start right-sidebar***************** -->

    <div class="col-3 bg-success ">
    <?php include("partial/left_sidebar.php"); ?>
   
    </div>
    <!-- ////////////////////////end side-bar//////////////-->
    <div class="col-6">
     <?php
     $selectweets = "select * from tweets_poem";
     $qurey =$conn->query($selectweets);
     if ($qurey->num_rows>0) {
   while ($row = $qurey->fetch_assoc() ) {
  echo '<div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-6">
      <img class="w-100" src="upload-image/'.$row['image'].'" alt="...">
    </div>
    <div class="col-md-6">
      <div class="card-body">
        <h5 class="card-title">'.$row['title'].'</h5>
        <p class="card-text">'.$row['Details'].'</p>
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
    </div>
  </div>
</div>';
   }
     }
     
     ?>
    </div>
    <div class="col-3 bg-success">
   
        <?php include("partial/right_sidebar.php"); ?>
 
    </div>
    </div>










<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>