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
    $_SESSION["return_to_url"] = $_SERVER['REQUEST_URI'];
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
          echo "<p><b>Genre: </b>".formatGenreInput($genre)."</p>\n";
          echo "<p><b>Description:</b> $description</p>\n";
        }
      $stmt->free_result();

      $db->close();
      ?>
      <form method="post" action="writeBlog.php">
        <input type="hidden" name="artID" value="<?php echo $art_id; ?>"/>
        <input type="submit" value="Blog About This Piece!">
      </form>
    </div>
  </body>
</html>
