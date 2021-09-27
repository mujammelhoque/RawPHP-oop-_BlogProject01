<?php
require __DIR__ . '/../vendor/autoload.php';

use App\classes\Session;
use App\classes\Database;
$conn = new Database;
if(isset($_GET['tid'])){
  $id = $_GET['tid'];
    $editQ = "SELECT * from ptweets where id='".$id."' and deleted is NULL";
$editQR = $conn->db->query($editQ);
$editQR = $editQR->fetch_assoc();
}


$insertTweet = "UPDATE `ptweets` SET `uid`='".$editQR['uid']."',`cid`='".$editQR['cid']."',`title`='".$editQR['title']."',`details`='".$editQR['details']."',`image`='".$editQR['image']."',`privacy`='2',`status`='1' where id ='".$id."'";
//echo $insertTweet;


$conn->db->query($insertTweet);
if($conn->db->affected_rows == 1){
 
  header("Location:index.php");
}
 //}

//get form values end
?>
