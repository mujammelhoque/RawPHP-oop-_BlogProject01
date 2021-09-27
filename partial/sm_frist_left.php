





                            

<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation" >
        <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01" class="">


         
<?php


$sqltotal = "SELECT COUNT(*) AS total FROM ptweets WHERE uid='.$userid.'";
							$allCat = $conn->query($sqltotal);
              $tt= $allCat->fetch_assoc();
              $total=$tt['total'];
			  /*   $q = "SELECT ptweets.*,mypoemcata.name  FROM `ptweets` 
                 inner join mypoemcata on ptweets.cid=mypoemcata.id
                 WHERE  ptweets.cid=".$cid ." order by ptweets.created desc LIMIT " . $recordStart . "," . PAGE_SIZE . "";*/ 

$sql = "SELECT ptweets.*, mypoemcata.name ,count(*) as total FROM `ptweets` 
							inner join mypoemcata on ptweets.cid=mypoemcata.id WHERE  ptweets.uid=".$userid ."  group by ptweets.`cid`";
							$allCategory = $conn->query($sql);
							echo ' <ul class="list-group">';
							echo '<li class="list-group-item d-flex justify-content-between align-items-center"> <h3>My Tweets 	&nbsp <h3> <span class="badge bg-primary rounded-pill">'.$total.'</span></li>';
							if ($allCategory->num_rows > 0) {
								
                echo ' <li class="list-group-item d-flex justify-content-between align-items-center"> <h4><a class="text-decoration-none" href="insertweet.php">Add Tweet</a><h4></li>';
								while ($cate = $allCategory->fetch_assoc()) {
								
                  echo '<a href="yourpoem.php?cid='.$cate['cid'].'"> <li class="list-group-item d-flex justify-content-between align-items-center">
                  ' . $cate['name'] . ' 
                      <span class="badge bg-primary rounded-pill">'.$cate['total'].'</span>
                    </li></a>';
								}
           
							}

							

							//built in catagories
							$sqltotal = "SELECT mypoem.`mpcid`,  mypoemcata.name ,count(*) as total FROM `mypoem` 
			  inner join mypoemcata on mypoem.mpcid=mypoemcata.id";
			  $allCat = $conn->query($sqltotal);
			  $tt = $allCat->fetch_assoc();
			  $total = $tt['total'];
	  
	  
			  $sql = "SELECT mypoem.`mpcid`,  mypoemcata.name ,count(*) as total FROM `mypoem` 
			  inner join mypoemcata on mypoem.mpcid=mypoemcata.id group by mypoem.`mpcid`";
			  $allCategory = $conn->query($sql);
		  if ($allCategory->num_rows > 0) {
			echo '
			<li class="list-group-item d-flex justify-content-between align-items-center"> <h4>Islamic story <h4> <span class="badge bg-primary rounded-pill">'.$total.'</span></li>';
			while ($cate = $allCategory->fetch_assoc()) {
		// echo '<a href="categorytweet.php?cid='.$cate['mpcid'].'">' . $cate['name'] . '<span>('.$cate['total'].')</span></a>';
			echo '<a href="mypoem.php?mpcid='.$cate['mpcid'].'"> 
			<li class="list-group-item d-flex justify-content-between align-items-center">'. $cate['name'] . '
			<span class="badge bg-primary rounded-pill">'.$cate['total'].'</span>
			 </li></a>';
			}
		}
		$sql = "SELECT poetpoem.`pcid`,  poetcata.name ,count(*) as total FROM `poetpoem` 
		inner join poetcata on poetpoem.pcid=poetcata.id group by poetpoem.`pcid`";
		$allCategory = $conn->query($sql);
		
		if ($allCategory->num_rows > 0) {
		  echo '<li class="list-group-item d-flex justify-content-between align-items-center"> <h2>Famous Poem<h3></li>';
		  while ($cate = $allCategory->fetch_assoc()) {
			// echo '<a href="categorytweet.php?cid='.$cate['mpcid'].'">' . $cate['name'] . '<span>('.$cate['total'].')</span></a>';
			echo '<a href="famous.php?pcid='.$cate['pcid'].'"> <li class="list-group-item d-flex justify-content-between align-items-center">
			' . $cate['name'] . ' 
				<span class="badge bg-primary rounded-pill">'.$cate['total'].'</span>
			  </li></a>';
		  }
		
		}


echo "</ul>";
           ?>
          


        </div>
    </div>
</nav>
                          