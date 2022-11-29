<?php
 require('header.php');
 require('./data/db.php');
 require('./assets/functions.php');
 require_ssl();
?>
<html>
  <?php
    //code largely recycled from Herman's A4
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); //connect to db
    if(mysqli_connect_errno()) die(mysqli_connect_error()); //test for successful connection
  ?>
  <head>
    <title>Sign Out</title>
    <link href="./CSS/main.css" rel="stylesheet">
  </head>

  <body>
    <?php
      unset($_SESSION['user']);
      session_destroy();
      if(isset($_SESSION["return_to_url"])) header("Location: http://".$_SERVER['HTTP_HOST'].$_SESSION["return_to_url"]);
      else header("Location: index.php");
    ?>
  </body>
</html>
