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
    <div class="content">
      <!--Featured Art/Blog?-->
    </div>
  </body>
</html>
