<?php
 require('header.php');
 require('./data/db.php');
 require('./assets/functions.php');
 require_ssl();
?>
<html>
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
