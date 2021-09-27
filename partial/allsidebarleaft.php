

<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">


          <?php
		  	$sqltotal = "SELECT mypoem.`mpcid`,  mypoemcata.name ,count(*) as total FROM `mypoem` 
			  inner join mypoemcata on mypoem.mpcid=mypoemcata.id";
			  $allCat = $conn->query($sqltotal);
			  $tt = $allCat->fetch_assoc();
			  $total = $tt['total'];
	  
	  
			  $sql = "SELECT mypoem.`mpcid`,  mypoemcata.name ,count(*) as total FROM `mypoem` 
			  inner join mypoemcata on mypoem.mpcid=mypoemcata.id group by mypoem.`mpcid`";
			  $allCategory = $conn->query($sql);
		  if ($allCategory->num_rows > 0) {
			echo ' <ul class="list-group">
			<li class="list-group-item d-flex justify-content-between align-items-center"> <h4>Islamic story <h4> <span class="badge bg-primary rounded-pill">'.$total.'</span></li>';
			while ($cate = $allCategory->fetch_assoc()) {
		// echo '<a href="categorytweet.php?cid='.$cate['mpcid'].'">' . $cate['name'] . '<span>('.$cate['total'].')</span></a>';
			echo '<a href="mypoem.php?mpcid='.$cate['mpcid'].'"> 
			<li class="list-group-item d-flex justify-content-between align-items-center">'. $cate['name'] . '
			<span class="badge bg-primary rounded-pill">'.$cate['total'].'</span>
			 </li></a>';
				}
		  echo ' </ul>';}
		  $sql = "SELECT poetpoem.`pcid`,  poetcata.name ,count(*) as total FROM `poetpoem` 
inner join poetcata on poetpoem.pcid=poetcata.id group by poetpoem.`pcid`";
$allCategory = $conn->query($sql);

if ($allCategory->num_rows > 0) {
  echo ' <ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center"> <h2>Famous Poem<h3></li>';
  while ($cate = $allCategory->fetch_assoc()) {
    // echo '<a href="categorytweet.php?cid='.$cate['mpcid'].'">' . $cate['name'] . '<span>('.$cate['total'].')</span></a>';
    echo '<a href="famous.php?pcid='.$cate['pcid'].'"> <li class="list-group-item d-flex justify-content-between align-items-center">
    ' . $cate['name'] . ' 
        <span class="badge bg-primary rounded-pill">'.$cate['total'].'</span>
      </li></a>';
  }
  echo ' </ul>';
}
		
		  ?>
		
        </div>
    </div>
</nav>