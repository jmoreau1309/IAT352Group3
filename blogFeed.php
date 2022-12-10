<?php
  include('./assets/functions.php');
  no_SSL();

  $query_str = "SELECT blogposts.blog_id, blogposts.title, blogposts.content, blogposts.time_created, artpieces.filename FROM blogposts
    INNER JOIN artpieces ON blogposts.art_id = artpieces.art_id";
  $res = $db->query($query_str);

    $stmt = $db->prepare($query_str);

    $stmt->execute();
    $stmt->bind_result($blog_id, $title, $content, $time_created, $filename);

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
          ?>
          <div class="row-padding">
          <div class="col l6 m6 margin-bottom">
          <div class="container padding-32">
          <h3 class="border-bottom border-light-pink padding"></h3>
        <h2>
         <?php
          echo "<img src=\"./assets/img/".$row['filename']."\" class=\"display-img\"/>";
          ?>
          </h2>
          </div>
        </div>
        </div>

         <?php
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
