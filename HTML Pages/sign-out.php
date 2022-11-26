<?php
 require('header.php');
 require("./data/db.php");
 require_ssl();
 session_start();
?>
<html>
  <?php
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); //connect to db
    if(mysqli_connect_errno()) die(mysqli_connect_error()); //test for successful connection
  ?>
  <head>
    <title>Sign Out</title>
    <link href="./main.css" rel="stylesheet">
  </head>

  <body>
    <?php
      include('assets/header.php'); //header
      unset($_SESSION['user']);
      session_destroy();
      if(isset($_SESSION["return_to_url"]))) header("Location: http://".$_SERVER['HTTP_HOST'].$_SESSION["return_to_url"]);
      else header("Location: http://".$_SERVER['HTTP_HOST']."index.php");
    ?>
  </body>
</html>
