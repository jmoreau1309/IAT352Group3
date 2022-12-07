<?php
 include('./assets/functions.php');
 no_SSL();
?>
<html>
  <?php
    include('header.php');
    $_SESSION["return_to_url"] = $_SERVER['REQUEST_URI'];

  ?>
  <head>
    <title>Art Blogger</title>
    <link href="./CSS/main.css" rel="stylesheet">
  </head>
  <body>
    <div class="content padding" style="max-width:1564px">
      <div class="container padding-32" id="home">
    <h2 class="border-bottom border-light-blue padding-16">Your Latest Activity</h2>
      </div>
    </div>
  </body>
</html>
