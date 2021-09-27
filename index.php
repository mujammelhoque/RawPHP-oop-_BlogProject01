<?php
require __DIR__ . '/vendor/autoload.php';
require "db.php";

use App\classes\Database;
use App\classes\Session;
use Carbon\Carbon;

$userid = Session::getSessionData("userid");
define('PAGE_SIZE', 5);

$defaultpage = 1;
if (isset($_GET['page'])) {
  $defaultpage = $_GET['page'];
}
$decrement = $defaultpage - 1;
$increment = $defaultpage + 1;
$recordStart = ($decrement) * PAGE_SIZE;
$pagi = "SELECT COUNT(*) AS total FROM ptweets";
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
      <div class="col-sm-12 col-md-6 col-lg-6 ">
        <!-- carouser start -->
        <?php require "partial/carousel.php"; ?>
        <!-- carousel end -->

        <?php
        $selectweets = "SELECT ptweets.*,ptweets.id as pid, users.username, users.id from ptweets inner join users on ptweets.uid= users.id where ptweets.privacy='1' order by ptweets.created desc LIMIT " . $recordStart . "," . PAGE_SIZE . "";
        $qurey = $conn->query($selectweets);
        echo '<div class="d-flex justify-content-between mt-1 mb-1"style="background-color: rgb(150, 95, 0 ,0.3);"><div><h3>All Posts</h3></div><div><h4><a class="text-decoration-none" href="insertweet.php">Add New</a></h4></div></div>';
        if ($qurey->num_rows > 0) {
          while ($row = $qurey->fetch_assoc()) {
            echo '<div class="card mb-3" style="max-width: 640px;">
            <div class="row g-0">
              <div class="col-md-6">
                <img class="w-100" src="pubimage/'.$row['image'].'" alt="...">
              </div>
              <div class="col-md-6">
                <div class="card-body">
                  <h5 class="card-title">'.$row['title'].'</h5>
                  <p class="card-text"><pre>'. mb_substr($row['details'], 0, 200) .'......</pre></p>
                  <p class="card-text">Posted by <em>' . $row['username'] . '</em><br><small class="text-muted">'.$row['created'].'</small></p>
                </div>
                <footer><a class="btn rounded-pill btn-sky mb-3" href="view2.php?id='.$row['pid'].'"><h3 class="btn bg-dark text-light">Read More </h3></a></footer>
              </div>
            </div>
          </div>';
          }
        }
/*echo '<div class="card mb-3" style="max-width: 640px;">
  <div class="row g-0">
    <div class="col-md-6">
      <img class="w-100" src="pubimage/'.$row['image'].'" alt="...">
    </div>
    <div class="col-md-6">
      <div class="card-body">
        <h5 class="card-title">'.$row['title'].'</h5>
        <p class="card-text"><pre>'. mb_substr($row['details'], 0, 200) .'......</pre></p>
        <p class="card-text">Posted by <strong>' . $row['username'] . '</strong><small class="text-muted">'.$row['created'].'</small></p>
      </div>
      <footer><a class="btn rounded-pill btn-sky mb-3" href="view2.php?id='.$row['id'].'"><h3 class="btn bg-dark text-light">Read More </h3></a></footer>
    </div>
  </div>
</div>'; */
        ?>
        
        <nav aria-label="Page navigation example">
          <ul class="pagination">


            <?php
            if ($defaultpage <= 1) {
              echo '<li class="page-item disabled"><a class="page-link" href="">Previous</a></li>';
            } else {
              echo '<li class="page-item "><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $decrement . '">Previous</a></li>';
            }




            for ($i = 1; $i <= $totalPage; $i++) {
              if (abs($defaultpage - $i) < 3) {


                if ($defaultpage == $i) {
                  // echo '<a class="page active" href="' . $_SERVER['PHP_SELF'] . '?page=' . $i . '&cid='.$mpcid.'">' . $i . '</a>';
                  echo '<li class="page-item"><a class="page-link active " href="' . $_SERVER['PHP_SELF'] . '?page=' . $i . ' ">' . $i . '</a></li>';
                } else {
                  // echo '<a class="page" href="' . $_SERVER['PHP_SELF'] . '?page=' . $i . '&cid='.$mpcid.'">' . $i . '</a>';
                  echo '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $i . ' ">' . $i . '</a></li>';
                }
              }
            }

            if ($defaultpage == $totalPage) {
              echo '<li class="page-item disabled"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $increment . ' ">Next</a></li>';
            } else {
              echo '<li class="page-item "><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $increment . ' ">Next</a></li>';
            }
            ?>
          </ul>
        </nav>


      </div>
      <div class="col-3 	d-none d-md-block d-lg-block bg-success" >


        <?php include("partial/right_sidebar.php"); ?>

      </div>
    </div>
    <?php  require "partial/footer.php"; ?>

  </div>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>