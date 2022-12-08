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
        <h2>Latest Blog Posts</h2>
        <?php
          $blogs_query = "SELECT title, blog_id FROM blogposts ORDER BY time_created DESC LIMIT 3";
          $blogs_result = mysqli_query($db, $blogs_query);
          if(mysqli_num_rows($blogs_result) != 0) {
            while($r= mysqli_fetch_assoc($blogs_result)){
              echo "<h3><a href=\"blogPiece.php?blogID=".$r['blog_id']."\">".$r['title']."</a></h3>";
            }
          }

          if (isset($_SESSION['user'])){
            echo "<h2>Your Latest Activity</h2>";
            //query 2 most recent blogs
            $sess_blogs_query = "SELECT title, blog_id FROM blogposts WHERE contributor_id=
            (SELECT user_id FROM users where username=\"".$_SESSION['user']."\")
            ORDER BY time_created DESC LIMIT 2";
            $sess_blogs_result = mysqli_query($db, $sess_blogs_query);
            if(mysqli_num_rows($sess_blogs_result) != 0) {
              while($r= mysqli_fetch_assoc($sess_blogs_result)){
                echo "<h3><a href=\"blogPiece.php?blogID=".$r['blog_id']."\">".$r['title']."</a></h3>";

                //query for 3 latest comments within blog post
                $comments_query = "SELECT comments.blog_id, comments.content, comments.time_created, users.username
                  FROM comments INNER JOIN users ON users.user_id = comments.user_id WHERE blog_id=".$r['blog_id']." LIMIT 3";
                $comments_result = mysqli_query($db, $comments_query);
                if(mysqli_num_rows($comments_result) != 0) { //display comments
                  while($r= mysqli_fetch_assoc($comments_result)){
                    echo "<p style=\"margin-left: 1em; margin-bottom: 0.25em\"><b>".$r["username"]."</b>".
                      " writes: <br/> - ".$r["content"]."<br/>".
                      "&#9<i>".$r["time_created"]."</i></p>";
                  }
                }
                else echo "No recent comments!";
              }
            }
            else echo "No recent activity!";
          }
        ?>
      </div>
    </div>
  </body>
</html>
