<?php

session_start();
$_SESSION['validuser'] = false;

require("db.php");
if (isset($_POST['submit'])) {
  if (isset($_FILES['image'])) {
    $name = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    $path = "upload-image/";
    move_uploaded_file($tmp,$path.$name);
  }
 


$uid = $_POST['uid'];
$title = $_POST['title'];
$details = $_POST['details'];

$insqurry = "insert into tweets_poem values (NULL, '".$uid."','".$title."','".$details."','".$name."')";
$conn->query($insqurry);
if ($conn->affected_rows) {

$_SESSION['validuser'] = true;
header("Location: index.php");

 

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
    <div class="container text-white ">

 
    <form action="" class="bg-success mt-5 p-4" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="u">userid:</label>
    <input type="text" name="uid" class="form-control"  id="u">
  </div>
  <div class="form-group">
    <label for="t">title:</label>
    <input type="text" name="title" class="form-control"  id="t">
  </div>
  <div class="form-group">
    <label for="d">details:</label>
    <textarea  class="form-control"  name="details" id="d" cols="80" rows="5"></textarea>
  </div>
  <div class="form-group">
    <label for="im">image:</label>
<input type="file" class="form-control" name="image" id="im">
  </div>


  <button type="submit" name="submit" class="btn btn-primary mt-5">Submit</button>
</form>


    
    </div>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>