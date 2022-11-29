<?php
include('./assets/functions.php');
no_SSL();

$code = trim($_GET['artID']);
@$msg = trim($_GET['message']);
?>
<html>
  <?php
    $query_str = "SELECT *
                  FROM artpieces
                  WHERE art_id = ?";

    $stmt = $db->prepare($query_str);
    $stmt->bind_param('s', $code);
    $stmt->execute();
    $stmt->bind_result($art_id, $artist, $yearRangeStart, $yearRangeEnd, $title, $genre, $description, $filename);

    include('header.php');
  ?>
  <head>
    <title>Art Piece Details</title>
    <link href="./CSS/main.css" rel="stylesheet">
  </head>

  <body>
    <div class="content">
      <?php
      if($stmt->fetch()) {
          echo "<img src=\"./assets/img/$filename\" class=\"display-img\"/>";
          echo "<h3>$title</h3>\n";
          echo "<p><b>by:</b> $artist, $yearRangeStart-$yearRangeEnd.</p>";
          echo "<p><b>Genre:</b>$genre</p>\n";
          echo "<p><b>Description:</b> $description</p>\n";
        }
      $stmt->free_result();

      $db->close();
      ?>
    </div>
  </body>
</html>
