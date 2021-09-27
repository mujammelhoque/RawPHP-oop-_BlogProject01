

<!-- <nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01"> -->


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

					while($cate['mpcid']==9){
						echo '<a href="mypoem.php?mpcid='.$cate['mpcid'].'"> 
						<li class="list-group-item d-flex justify-content-between align-items-center ">'. $cate['name'] . '<span>
						
						<span class="dropdown d-flex">
						<a class="btn ms-4 btn-outline-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
						</a></span><span class="badge bg-primary rounded-pill">'.$cate['total'].'</span>';

						$reselect = "SELECT * from subcata inner join mypoem on subcata.id=mypoem.sub WHERE subcata.status=1 group by mypoem.`sub`  ";
				$requery = $conn->query($reselect);
				echo ' <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">';
				while($rere = $requery->fetch_assoc()){
					echo '
					<li><a class="dropdown-item" href=substory.php?mpcid='.$rere['sub'].'><small>'. $rere['subname'] . '</small></a></li>';
				}
				 echo' </ul> </span> </li></a>';
					 break;
					 }
			

					while($cate['mpcid']==10){
						echo '<a href="mypoem.php?mpcid='.$cate['mpcid'].'"> 
						<li class="list-group-item d-flex justify-content-between align-items-center ">'. $cate['name'] . '<span>
						
						<span class="dropdown d-flex">
						<a class="btn btn-outline-dark dropdown-toggle " href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
						</a></span><span class="badge bg-primary rounded-pill">'.$cate['total'].'</span>';

						$reselect = "SELECT * from subcata inner join mypoem on subcata.id=mypoem.sub  WHERE subcata.status=2 group by mypoem.`sub` ";
				$requery = $conn->query($reselect);
				echo ' <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">';
				while($rere = $requery->fetch_assoc()){
					echo '
					<li><a class="dropdown-item" href=substory.php?mpcid='.$rere['sub'].'><small>'. $rere['subname'] . '</small></a></li>';
				}
				 echo' </ul> </span> </li></a>';
					 break;
					 }
			
			 if($cate['mpcid']==9){
				continue;
			}
			
			 if($cate['mpcid']==10){
				continue;
			}
			 echo '<a href="mypoem.php?mpcid='.$cate['mpcid'].'"> 
			 <li class="list-group-item d-flex justify-content-between align-items-center">'. $cate['name'] . '<span class="badge bg-primary rounded-pill">'.$cate['total'].'</span>
			  </li></a>';
		}

			  echo ' </ul>';
				}
		
		
		  ?>
		
        <!-- </div>
    </div>
</nav> -->