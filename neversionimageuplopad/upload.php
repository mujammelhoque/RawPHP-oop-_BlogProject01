<?php

$target_dir="files/";
if(isset($_FILES['fileUpload']['name']));
$total_files = count($_FILES['fileUpload']['name']);
for ($key=0; $key < $total_files; $key++) { 
    if (isset($_FILES['fileUpload']['name'])&& $_FILES['fileUpload']['size'][$key]>0) {
        $original_filename=$_FILES['fileUpload']['name'][$key];
        $target= $target_dir.basename($original_filename);
        $tmp= $_FILES['fileUpload']['tmp_name'][$key];
        move_uploaded_file($tmp, $target);
        # code...
    }
    # code...
}
//header('location:index.php');