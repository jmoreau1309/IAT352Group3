<?php
 include('./assets/functions.php');
 require('./data/db.php');
 no_SSL();
?>
<html>
  <?php
    include('header.php');

    $_SESSION["return_to_url"] = $_SERVER['REQUEST_URI'];
  ?>
  <head>
    <title></title>
    <link href="./CSS/main.css" rel="stylesheet">
  </head>
  <body>
    <div class="content">
      <?php
        $art_query = "SELECT artpieces.title, artpieces.filename, artpieces.art_id FROM artpieces WHERE art_id=".$_POST["art_id"];
        $art_result = mysqli_query($db, $art_query);
        if (!$art_result) die("Database query failed."); //test for error

        if(mysqli_num_rows($art_result) != 0){
          while($r=mysqli_fetch_assoc($art_result)){
            echo "<img src=\"./assets/img/".$r["filename"]."\" class=\"display-img\"/><br/><br/>";
            echo "<i>".$r["title"]."</i><br/>";
          }
        }
      ?>
    </div>
  </body>
</html>
