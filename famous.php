<?php
require __DIR__ . '/vendor/autoload.php';
include "db.php";

use App\classes\Session;

$userid = Session::getSessionData("userid");
?>
<?php
  

  define('PAGE_SIZE', 3);
if(!isset($_GET['pcid'])){ die(); exit;}
else{
    $pcid = filter_var($_GET['pcid'],FILTER_VALIDATE_INT);
}
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
    $defaultpage = 1;
    if (isset($_GET['page'])) {
      $defaultpage = $_GET['page'];
    }
    $decrement =  $defaultpage -1 ;
    $increment =  $defaultpage +1 ;
     	$recordStart = ($decrement) * PAGE_SIZE;
       $pagi = "SELECT COUNT(*) AS total FROM poetpoem WHERE pcid=".$pcid." ";
       $allpagei = $conn->query($pagi);
       $allpageiCount = $allpagei->fetch_assoc();
       // echo $allpageiCount['total'];
       $totalPage = ceil($allpageiCount['total'] / PAGE_SIZE);

       //$q = "SELECT * FROM `tweets` WHERE privacy = '1' and cid=".$cid." order by created desc LIMIT " . $recordStart . "," . PAGE_SIZE . "";
       $q = "SELECT poetpoem.*,poetcata.name  FROM `poetpoem` 
                 inner join poetcata on poetpoem.pcid=poetcata.id
                 WHERE  poetpoem.pcid=".$pcid." order by poetpoem.created desc LIMIT " . $recordStart . "," . PAGE_SIZE . "";
       $n = "SELECT poetpoem.*,poetcata.name  FROM `poetpoem` 
                 inner join poetcata on poetpoem.pcid=poetcata.id
                 WHERE  poetpoem.pcid=".$pcid." order by poetpoem.created desc LIMIT " . $recordStart . "," . PAGE_SIZE . "";
        //echo $q;
       // $q = "select * from tweets";
    
       $nameTweet = $conn->query($n);
       if ($nameTweet->num_rows > 0) {
         $tt = $nameTweet->fetch_assoc();
        //  echo " Poem of" .$tt["name"];
         echo '<h3>Poem of '.$tt["name"].'</h3>';
       }
     
    $allTweet = $conn->query($q);
     if ($allTweet->num_rows>0) {
     
   while ($row = $allTweet->fetch_assoc() ) {
    
  echo '<div class="card mb-3" style="max-width: 640px;">
  <div class="row g-0">
    <div class="col-md-6">
      <img class="w-100" src="poetimage/'.$row['image'].'" alt="...">
    </div>
    <div class="col-md-6">
      <div class="card-body">
        <h5 class="card-title">'.$row['title'].'</h5>
        <p class="card-text"><pre>'. mb_substr($row['details'], 0, 200) .'......</pre></p>
        <p class="card-text"><small class="text-muted">'.$row['created'].'</small></p>
      </div>
      <footer><a class="btn rounded-pill btn-sky mb-3" href="view.php?id='.$row['id'].'"><h3 class="btn bg-dark text-light">Read More </h3></a></footer>
    </div>
  </div>
</div>';
   }
     }
    

     
     ?>
 <nav aria-label="Page navigation example">
  <ul class="pagination">
						
						

           

						<?php
            if ($defaultpage <= 1) {
              echo '<li class="page-item disabled"><a class="page-link" href="">Previous</a></li>';

            }else{
              echo '<li class="page-item "><a class="page-link" href="'.$_SERVER['PHP_SELF'] .'?page='.$decrement.'&pcid='.$pcid.' ">Previous</a></li>';

            }
           
						for ($i = 1; $i <= $totalPage; $i++) {
							if (abs($defaultpage - $i) < 3) {


								if ($defaultpage == $i) {
							
                  echo '<li class="page-item"><a class="page-link active " href="'.$_SERVER['PHP_SELF'] .'?page='.$i.'&pcid='.$pcid.' ">' . $i . '</a></li>';
                 
								} else {
								
                  echo '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'] .'?page='.$i.'&pcid='.$pcid.' ">' . $i . '</a></li>';
								}
							}
						}

            if ($defaultpage ==$totalPage) {
              echo '<li class="page-item disabled"><a class="page-link" href="'.$_SERVER['PHP_SELF'] .'?page='.$increment.'&pcid='.$pcid.' ">Next</a></li>';

            }else{
              echo '<li class="page-item "><a class="page-link" href="'.$_SERVER['PHP_SELF'] .'?page='.$increment.'&pcid='.$pcid.' ">Next</a></li>';

            }
						?>
             </ul>
             </nav>
    
    </div>
    <div class="col-3 	d-none d-md-block d-lg-block bg-success">
    <?php include("partial/right_sidebar.php"); ?>
    </div>
    </div>
    <?php echo include "partial/footer.php"?>

</div>








<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>