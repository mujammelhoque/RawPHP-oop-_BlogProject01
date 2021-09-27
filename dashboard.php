<?php
use App\classes\Session;
require __DIR__ . '/vendor/autoload.php';
if(!Session::getSessionData("loggedin")){
    header("Location:login.php");
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
</head>
<style>.text{color: red;}</style>
<body>
    <?php
    require "partial/navbar.php";
    ?>
    <h1>You are welcome</h1>
    <h1>You are welcome</h1>
    <h1>You are welcome</h1>
    <h1>You are welcome</h1>
    <h1 class="text">welcome <?php echo Session::getSessionData("username") ?> : <?php echo Session::getSessionData("userid") ?></h1>
    <h1>You are welcome</h1>
    <h1>You are welcome</h1>
    <h1>You are welcome</h1>
    <h1>You are welcome</h1>
    <h1>You are welcome</h1>
    <h1>You are welcome</h1>
    <h1>You are welcome</h1>
    <h1>You are welcome</h1>
    <h1>You are welcome</h1>
    <h1>You are welcome</h1>
    <h1>You are welcome</h1>
    <h1>You are welcome</h1>
    <h1>You are welcome</h1>
    <h1>You are welcome</h1>
    <h1>You are welcome</h1>


    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>