<?php
require __DIR__ . '/../vendor/autoload.php';
require"db.php";
use App\classes\Session;
use App\classes\Database;

if(isset($_GET['tid'])){
  $id = $_GET['tid'];
    $editQ = "SELECT * from ptweets where id='".$id."'and deleted is NULL";
$editQR = $conn->query($editQ);
$editQR = $editQR->fetch_assoc();
}

if(isset($_POST['UpdateTweet'])){
  $id = $_GET['tid'];

$catid = $_POST['inputCat'];
$userid = $_POST['inputuid'];
$title = $_POST['inputTitle'];
$details = $_POST['inputDetails'];
$privacy = $_POST['pv'];
if(!empty($_FILES['inputImage']['name'])){
  $originalName = time()."_".$userid."_".rand(1000,9999).".jpg";
  $imagename = "../pubimage/".$originalName;
  move_uploaded_file($_FILES['inputImage']['tmp_name'],$imagename);

 }

$insertTweet = "UPDATE `ptweets` SET `cid`='".$catid."',`title`='".$title."',`details`='".$details."',`image`='".$originalName."',`privacy`='".$privacy."',`status`='1' where id='".$id."' ";



$conn->query($insertTweet);
if($conn->affected_rows == 1){
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

    <form method="POST" action="edit.php?tid=<?php echo $id;?>" enctype="multipart/form-data">
    <input value="<?php echo $editQR['uid'] ?>" type="text" hidden class="form-control" id="inputuid" name="inputuid">
  <div class="row mb-3">

    <label for="inputTitle" class="col-sm-2 col-form-label">Title</label>
    <div class="col-sm-10">
      <input value="<?php echo $editQR['title'] ?>" type="text" class="form-control" id="inputTitle" name="inputTitle">
    </div>
  </div>

  <div class="row mb-3">
    <label for="inputDetails" class="col-sm-2 col-form-label">Details</label>
    <div class="col-sm-10">
      <textarea class="form-control" id="inputDetails" name="inputDetails"><?php echo $editQR['details'] ?></textarea>
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputImage" class="col-sm-2 col-form-label">Image</label>
    <div class="col-sm-6">
      <input type="file" class="form-control" id="inputImage" name="inputImage" accept="pubimage/*;capture=camera">
    </div>

  </div>
  <div class="row mb-3">
    <label for="inputCat" class="col-sm-2 col-form-label">Category</label>
    <div class="col-sm-10">
    <select id="inputCat" name="inputCat" class="form-select form-control">
    <option selected value="-1">Choose...</option>
    <?php

$res = $conn->query("select * from mypoemcata where status=2");
if ($res->num_rows > 0) {
    // $rows = [];
    while ($r = $res->fetch_assoc()) {
        // $rows[] = $r;
        echo '<option value="'.$r['id'].'">'.$r['name'].'</option>';
    }
  }

    ?>
    </select>
    </div>
  </div>
  <fieldset class="row mb-3">
    <legend class="col-form-label col-sm-2 pt-0">Privacy</legend>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="pv" id="pvonlyme" value="0">
        <label class="form-check-label" for="pvonlyme">
          Only Me
        </label>
      </div>
      <div class="form-check">
      <input class="form-check-input" type="radio" name="pv" id="pvpublic" value="1" checked>
        <label class="form-check-label" for="pvpublic">
          Public
        </label>
      </div>
      <div class="form-check disabled">
      <input class="form-check-input" type="radio" name="pv" id="pvfriends" value="2">
        <label class="form-check-label" for="pvfriends">
          Friends
        </label>
      </div>
    </div>
  </fieldset>

  <button type="submit" class="btn btn-primary" name="UpdateTweet"> Update</button>
</form>
  </div>
 </div>
<!-- footer start -->
<?php //require "partial/footer.php"; ?>
<!-- footer end -->



<script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/ef16f745ed.js" crossorigin="anonymous"></script>

      
  </body>
</html>

