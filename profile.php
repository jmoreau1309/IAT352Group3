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
    <title>Profile</title>
    <link href="./CSS/main.css" rel="stylesheet">
  </head>
  <body>
    <?php
      //redirect to index if no set user ID
      if(!isset($_GET["userID"])) header("Location: index.php");

      $user_query = "SELECT username FROM users WHERE user_id=\"".$_GET["userID"]."\"";
      $user_result = mysqli_query($db, $user_query);
      if(mysqli_num_rows($user_result) != 0) $username = mysqli_fetch_assoc($user_result)["username"];
      else header("Location: index.php") //contingency
    ?>
    <div class="content">
      <h1>User Profile for <?php echo $username; ?></h1>
      <h2>Blog Posts:</h2>
      <?php
        //query blog posts
        $blogs_query = "SELECT blog_id, title FROM blogposts WHERE contributor_id=\"".$_GET["userID"]."\"";
        $blogs_result = mysqli_query($db, $blogs_query);
        if(mysqli_num_rows($blogs_result) != 0) {
          while($r= mysqli_fetch_assoc($blogs_result)){
            echo "<h3><a href=\"blogPiece.php?id=".$r["blog_id"]."\">".$r["title"]."</a></h3>";
          }
        }
        else echo "This user hasn't created any blog posts."
      ?>
      <h2>Recent Comments:</h2>
      <?php
        //query up to 10 recent comments
        $comments_query = "SELECT blog_id, content, time_created FROM comments WHERE user_id=\"".$_GET["userID"]."\" LIMIT 10";
        $comments_result = mysqli_query($db, $comments_query);
        if(mysqli_num_rows($comments_result) != 0) {
          while($r= mysqli_fetch_assoc($comments_result)){
            $comment_blog_query = "SELECT title FROM blogposts WHERE blog_id=\"".$r["blog_id"]."\"";
            $comment_blog_result = mysqli_query($db, $comment_blog_query);
            echo "<h3><a href=\"blogPiece.php?id=".$r["blog_id"]."\">".mysqli_fetch_row($comment_blog_result)[0]."</a></h3>";
            echo "<p style=\"margin-left: 1em\"> - ".$r["content"]."&#9<i>(Created: ".$r["time_created"].")</i></p>";
          }
        }
        else echo "This user hasn't created any comments."
      ?>
    </div>
  </body>
</html>
