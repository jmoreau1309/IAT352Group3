<?php
  include('./assets/functions.php');
  no_SSL();

  $query_str = "SELECT blogposts.title, blogposts.content, blogposts.time_created, blogposts.blog_id FROM blogposts";
  $res = $db->query($query_str);

  function format_model_name_as_link($title, $blog_ID, $page) {
    echo "<a href=\"$page?blogID=$blog_ID\">$title</a>";
  }
?>
<html>
  <?php
    include('header.php');
    $_SESSION["return_to_url"] = $_SERVER['REQUEST_URI'];
  ?>
  <head>
    <title> Blog Feed </title>
    <link href="./CSS/main.css" rel="stylesheet">
  </head>
  <body>
    <div class="content">
      <?php
        echo "<h2>Blog Feed</h2>";

        echo "<ul>";
        while ($row = $res->fetch_assoc()) {
          echo "<li>";
          format_model_name_as_link($row['title'], $row['blog_id'],"blogPiece.php");
          echo "</li>\n";
        };
        echo "</ul>";

        $res->free_result();
        $db->close();

      ?>
    </div>
  </body>
</html>
