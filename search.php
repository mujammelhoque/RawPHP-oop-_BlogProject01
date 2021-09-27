
  <?php
require __DIR__ . '/vendor/autoload.php';
require "db.php";
use App\classes\Database;
use App\classes\Session;
use Carbon\Carbon;
$userid = Session::getSessionData("userid");
define('PAGE_SIZE', 2);
// if (isset($_GET['submit'])) {
    
// }
$search = $_GET['search'];

$defaultpage = 1;
if (isset($_GET['page'])) {
  $defaultpage = $_GET['page'];
}
$decrement = $defaultpage -1;
$increment = $defaultpage +1;
   $recordStart = ($decrement) * PAGE_SIZE;
   $pagi = "SELECT COUNT(*) AS total FROM ptweets where details LIKE '% $search %'  OR title LIKE '%$search%'";
   $allpagei = $conn->query($pagi);
   $allpageiCount = $allpagei->fetch_assoc();
   $totalPage = ceil($allpageiCount['total'] / PAGE_SIZE);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    

</head>
<body>
<div class="container-fluid">


<!-- ******************start navbar***************** -->
<?php include("partial/navbar.php"); ?>
<!-- ////////////////////////end navbar//////////////-->

<div class="row align-items-start mt-2">
<!-- ******************start right-sidebar***************** -->

    <div class="col-md-3 col-sm-12 bg-success ">
    

    <div class="row">
    <div class="col-12 col-sm-12  d-block bg-warning col-md-12 ">
        
       <?php
          if (Session::getSessionData("loggedin")) {
            include("partial/left_yoursidebar.php"); 
        
          }else{
            include("partial/left_sidebar.php"); 
          }
      ?>
    </div>
    <div class="col-12 col-sm-12 d-md-none  d-block bg-warning">
        
       <?php
      
      include("partial/right_sidebar.php"); 
          
      ?>
    </div>
        
    </div>
  
   
    </div>
    <!-- ////////////////////////end side-bar//////////////-->
    <div class="col-sm-12 col-md-6 col-lg-6 ">
     <?php
     $selectweets = "SELECT * FROM ptweets WHERE details LIKE '% $search %' OR title LIKE '%$search%' ORDER BY created DESC LIMIT " . $recordStart . "," . PAGE_SIZE . "";
     $qurey =$conn->query($selectweets);
     echo '<div class="d-flex justify-content-between"><div><h3>All Tweets</h3></div><div><h4><a class="text-decoration-none" href="insertweet.php">Add Tweets</a></h4></div></div>';
     if ($qurey->num_rows>0) {
   while ($row = $qurey->fetch_assoc() ) {
  echo '<div class="card mb-3" style="max-width: 640px;">
  <div class="row  g-0">
    <div class="col-md-6">
      <img class="w-100 h-75" src="pubimage/'.$row['image'].'" alt="...">
    </div>
    <div class="col-md-6">
      <div class="card-body">
        <h5 class="card-title">'.$row['title'].'</h5>
        <p class="card-text"><pre>'. mb_substr($row['details'], 0, 180) .'......<pre></p>
        <p class="card-text"><small class="text-muted">'.$row['created'].'</small></p>
      </div>
      <footer><a class="btn rounded-pill btn-sky mb-3" href="view2.php?id='.$row['id'].'"><h3 class="btn bg-dark text-light">Read More </h3></a></footer>
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
              echo '<li class="page-item "><a class="page-link" href="'.$_SERVER['PHP_SELF'] .'?page='.$decrement.'&search='.$search.' ">Previous</a></li>';

            }
           



						for ($i = 1; $i <= $totalPage; $i++) {
							if (abs($defaultpage - $i) < 3) {


								if ($defaultpage == $i) {
                  echo '<li class="page-item"><a class="page-link active " href="'.$_SERVER['PHP_SELF'] .'?page='.$i.'&search='.$search.'  ">' . $i . '</a></li>';
                 
								} else {
                  echo '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'] .'?page='.$i.'&search='.$search.'  ">' . $i . '</a></li>';
								}
							}
						}

            if ($defaultpage ==$totalPage) {
              echo '<li class="page-item disabled"><a class="page-link" href="'.$_SERVER['PHP_SELF'] .'?page='.$increment.' ">Next</a></li>';

            }else{
              echo '<li class="page-item "><a class="page-link" href="'.$_SERVER['PHP_SELF'] .'?page='.$increment.'&search='.$search.' ">Next</a></li>';

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




<!-- if (isset($_POST['submit'])) {
    $search = $_POST['search'];
    # code...
}
$selectweets = "SELECT * from ptweets where details LIKE '% $search %'"; -->



<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

