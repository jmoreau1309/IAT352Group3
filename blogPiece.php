<?php
 include('./assets/functions.php');
 require('./data/db.php');
 no_SSL();


?>
<html>
   <?php
    $query_str = "SELECT *
                  FROM blogposts
                  WHERE blog_id = ?";

    $stmt = $db->prepare($query_str);
    $stmt->bind_param('s', $code);
    $stmt->execute();
    $stmt->bind_result($blog_id, $title, $art_id, $content, $contributor_id, $time_created);

    include('header.php');
    $_SESSION["return_to_url"] = $_SERVER['REQUEST_URI'];
  ?>
  <head>
    <title>Blog Post</title>
    <link href="./CSS/main.css" rel="stylesheet">
  </head>
  <body>
    <div class="content">
       <?php
      if($stmt->fetch()) {
          echo "<h3>$title</h3>\n";
          echo "<p><b>by:</b></p>";
          echo "<p><i>$content</i></p>\n";
          echo "<p>$time_created</p>\n";
        }
      $stmt->free_result();

      $db->close();
      ?>
       <form method="post" action="writeComment.php">
        <input type="hidden" name="blog_id" value="<?php echo $blog_id; ?>"/>
        <input type="submit" value="Comment on This">
      </form>
    </div>
  </body>
</html>
