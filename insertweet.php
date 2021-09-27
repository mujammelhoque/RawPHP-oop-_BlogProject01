<?php
require __DIR__ . '/vendor/autoload.php';
use App\classes\Session;
include "db.php";
if(!Session::getSessionData("loggedin")){
  header("Location:login.php");
}


if(isset($_POST['submit'])){
    // var_dump($_FILES['inputImage']);
    // if(!empty($_FILES['inputImage']['name'])){ echo "true";}
    // exit;
$userid = Session::getSessionData("userid");
  $catid = $_POST['cata'];
  $title = $_POST['title'];
  $details = $_POST['details'];
  $privacy = $_POST['priv'];
  if(!empty($_FILES['image']['name'])){
    $originalName = time()."_".$userid."_".rand(1000,9999).".jpg";
    $imagename = "pubimage/".$originalName;
    if(move_uploaded_file($_FILES['image']['tmp_name'],$imagename)){
    //   Image::make($imagename)->resize(640, 480)->insert('assets/img/logo2.png','center')->save($imagename);
    }
  }
  else{
    $imagename = NULL;
  }
  //INSERT INTO `tweets`(`id`, `uid`, `cid`, `title`, `details`, `image`, `privacy`, `status`, `created`, `updated`, `deleted`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11])
  $insertTweet = "insert into ptweets values(NULL,'".$userid."','".$catid."','".$title."','".$details."','".$originalName."','".$privacy."','1',NULL,NULL,NULL)";
 
  $conn->query($insertTweet);
  if($conn->affected_rows == 1){
    // Session::setSessionData('message',"Tweet Added");
    header("Location:index.php");
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
    
    <!-- ******************start navbar***************** -->
    <?php include("partial/navbar.php"); ?>
    <!-- ////////////////////////end navbar//////////////-->
    
    <h1>welcome <?php echo Session::getSessionData("username") ?> : <?php echo Session::getSessionData("userid") ?></h1>
   
 
    <form action="" class="bg-success mt-5 p-4" method="POST" enctype="multipart/form-data">
    
    <caption><div class="bg-warning text-center"><h2>welcome <?php echo Session::getSessionData("username") ?> : Please make your tweets</h2></div></caption>
  <div class="form-group">
    <label class="text-light" for="c">Catagories</label>
    <select class="form-select" name="cata" id="c" aria-label="Default select example">
  <option value="-1">select one</option>
  <?php

// $categories = $dbhelp->toArray("categories");
$a = "select * from mypoemcata where status=2";
$b= $conn->query($a);
if ($b->num_rows >0) {
   while($rr = $b->fetch_assoc()){
echo '<option value='.$rr['id'].' >'.$rr['name'].'</option>';
   }
}

    ?>
</select>
  </div>
  <!--  -->
  <div class="form-group">
    <label class="text-light" for="p">title</label>
  <input type="text" class="form-control"  name="title" id="p">
  </div>
  <div class="form-group">
    <label class="text-light" for="d">details</label>
  <textarea name="details" class="form-control" id="" cols="30" rows="4"></textarea>
  </div>
<!-- *********privacy******** -->
<div class="form-check mt-2">
  <input class="form-check-input" value="1" type="radio" name="priv" id="pr1" checked>
  <label class="form-check-label text-light"  for="pr1">
    public
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" value="2" type="radio" name="priv" id="pr2">
  <label class="form-check-label text-light" for="pr2">
private
  </label>
</div>

<!-- ***************** -->



  <div class="form-group">
    <label class="text-light" for="im">image</label>
  <input type="file" class="form-control"  name="image" id="im">
  </div>
  
  <button type="submit" name="submit" class="btn btn-primary mt-5">Submit</button>

    </form>
    <?php  require "partial/footer.php"; ?>
    </div>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
