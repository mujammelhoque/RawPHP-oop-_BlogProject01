<?php
require __DIR__ . '/../vendor/autoload.php';

use App\classes\Database;
use App\classes\Session;
$conn = new Database;

?>
<?php
  

if(isset($_GET['tid'])){ 
  $id = ($_GET['tid']); 
 $q = "select * from `ptweets` where id='".$id."' limit 1";
       $qr = $conn->db->query($q);
   if($qr->num_rows == 1){
  $info= $qr->fetch_assoc();
 }  }


if(isset($_GET['id'])){ $id = filter_var($_GET['id'],FILTER_VALIDATE_INT);}



  ?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>view</title>


    

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

<meta name="theme-color" content="#7952b3">
    <!-- Custom styles for this template -->
    <link href="assets/css/starter-template.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
  </head>
<body>
<div class="container-fluid">

<div class="row align-items-start mt-2">
<!-- ******************start left-sidebar***************** -->

<div class="col-md-3 col-sm-12 bg-success ">

</div>
    <!-- ////////////////////////end side-bar//////////////-->
    <div class="col-sm-12 col-md-6 col-lg-6">
     <?php
    
       $q = "SELECT ptweets.*,mypoemcata.name  FROM `ptweets` 
                 inner join mypoemcata on ptweets.cid=mypoemcata.id
                 WHERE  ptweets.id=".$id." ";
        //echo $q;
       // $q = "select * from tweets";
       $allTweet = $conn->db->query($q);

  
     if ($allTweet->num_rows>0) {
       $row = $allTweet->fetch_assoc() ;
  echo '<div class="card mb-3" style="max-width: 640px;">
  <div class="row g-0">
   
    <div class="col-md-12">
      <div class="card-body ">
        <h5 class="card-title"><pre>'.$row['title'].'</pre></h5>
        <p class="card-text "> <pre>'. $row['details'].' </pre></p>
        <p class="card-text"><small class="text-muted">'.$row['created'].'</small></p>
      </div>
      <div class="col-md-12">
      <img class="w-100" src="../pubimage/'.$row['image'].'" alt="...">
    </div>
    </div>
  </div>
</div>
<div class="d-flex justify-content-between">
<div>';


     }
    ?>

  
 
    </div>
    <div class="col-3	d-none d-md-block d-lg-block bg-success">
   
    </div>


    </div>
    </div>



<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>