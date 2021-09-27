<?php

use App\classes\Session;
?>
<nav class="navbar navbar-expand-lg navbar-dark " style="background-color: rgb(150, 95, 0 ,0.5);">
<div class="container-fluid">
  <a class="navbar-brand"  href="#"><img style="width: 80px; height:50px " src="image/download.jfif" alt=""></a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarScroll">
    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
      <li class="nav-item ">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="insertweet.php">Insert</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
      </li>
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Link
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
      </li> -->
     
    </ul>
    <form class="d-flex" action="search.php" method="GET">
      <input class="form-control me-2" type="search " name="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success btn-sm"  name="submit" type="submit">Search</button>
    </form>
    <?php
if(Session::getSessionData("loggedin")){
echo "<li class='nav-item list-style-none ' style='list-style:none'><a class='text-light' href='#' >".Session::getSessionData("username") . "</a></li><li class='nav-item btn btn-primary btn-sm '> <a class='text-light text-decoration-none' href='logout.php'> Logout</a></li>";
}else{
      ?>
      <a class="btn btn-outline-success" type="button" href="login.php">Login</a> 
      <a class="btn btn-outline-success" type="button" href="registration.php">Registration</a>
    <?php
}
    ?>
</div>
</div>
</nav>

