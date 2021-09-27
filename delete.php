<?php
require __DIR__ . '/vendor/autoload.php';
require"db.php";
use App\classes\Session;
use App\classes\Database;
// use Intervention\Image\ImageManagerStatic as Image;
// $conn = new Database();
if(!Session::getSessionData("loggedin")){
    header("Location:login.php");
}

//load tweet values fo form start
if(isset($_GET['tid'])){
  $id = $_GET['tid'];
    // $id = $conn->escape($_GET['tid']);
    $uid = Session::getSessionData("userid");
    $editQ = "select * from ptweets where id='".$id."' and uid='".$uid."' and deleted is NULL";
$editQR = $conn->query($editQ);
$editQR = $editQR->fetch_assoc();
}


$insertTweet = "UPDATE `ptweets` SET `cid`='".$editQR['cid']."',`title`='".$editQR['title']."',`details`='".$editQR['details']."',`image`='".$editQR['image']."',`privacy`='2',`status`='1' where uid='".$uid ."' and id ='".$id."'";
//echo $insertTweet;


$conn->query($insertTweet);
if($conn->affected_rows == 1){
  Session::setSessionData('message',"Tweet Added");
  header("Location:index.php");
}
 //}

//get form values end
?>
