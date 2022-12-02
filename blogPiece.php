<?php
 include('./assets/functions.php');
 require('./data/db.php');
 no_SSL();

 $code = trim($_GET['blogID']);
 @$msg = trim($_GET['message']);
?>
<html>
   <?php
    $query_str = "SELECT blogposts.blog_id, blogposts.title, blogposts.art_id,
                  blogposts.content, blogposts.contributor_id, blogposts.time_created,
                  users.username
                  FROM blogposts INNER JOIN users ON blogposts.contributor_id=users.user_id
                  WHERE blog_id = ?";

    $stmt = $db->prepare($query_str);
    $stmt->bind_param('s', $code);
    $stmt->execute();
    $stmt->bind_result($blog_id, $title, $art_id, $content, $contributor_id, $time_created, $contributor);

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
          echo "<h2>$title</h2>\n";
          echo "<p><b>by: $contributor</b></p>";
          echo "<p><i>$content</i></p>\n";
          echo "<p>$time_created</p>\n";
        }
      $stmt->free_result();
      ?>
       <form method="post" action="writeComment.php">
        <input type="hidden" name="blogID" value="<?php echo $blog_id; ?>"/>
        <input type="submit" value="Comment on This">
      </form>

      <h3>Comments:</h3>
      <?php
        $cmt_query = "SELECT comments.blog_id, comments.content, comments.time_created, users.username
          FROM comments INNER JOIN users ON users.user_id = comments.user_id
          WHERE blog_id=".$_GET["blogID"];
        $cmt_result = mysqli_query($db, $cmt_query);
        if(mysqli_num_rows($cmt_result) != 0) { //display comments
          while($r= mysqli_fetch_assoc($cmt_result)){
            echo "<p style=\"margin-left: 1em; margin-bottom: 0.25em\"><b>".$r["username"]."</b>".
              " writes: <br/> - ".$r["content"]."<br/>".
              "&#9<i>".$r["time_created"]."</i></p>";
          }
        }
        else echo "No comments have been posted to this blog post yet!";
        $db->close();
      ?>
    </div>
  </body>
</html>
