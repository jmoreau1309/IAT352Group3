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
      if(isset($_GET["username"])){
        $userid_query = "SELECT user_id FROM users WHERE username=\"".$_GET["username"]."\"";
        $userid_result = mysqli_query($db, $userid_query);
        if(mysqli_num_rows($userid_result) != 0) header("Location: profile.php?userID=".mysqli_fetch_assoc($userid_result)['user_id']);
        else header("Location: index.php"); //contingency, shouldnt happen
      }
      else if(!isset($_GET["userID"])) header("Location: index.php"); //redirect to index if no set user ID

      $user_query = "SELECT username FROM users WHERE user_id=\"".$_GET["userID"]."\"";
      $user_result = mysqli_query($db, $user_query);
      if(mysqli_num_rows($user_result) != 0) $username = mysqli_fetch_assoc($user_result)["username"];
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
            ?>
            <div class="col l4 m6 margin-bottom">
            <div class="display-container">
            <?php
            echo "<h3><a href=\"blogPiece.php?blogID=".$r["blog_id"]."\">".$r["title"]."</a></h3>";
            ?>
          </div>
        </div>
            <?php
          }
        }
        else echo "This user hasn't created any blog posts."
      ?>
      <div class="row-padding">
      <h2>Recent Comments:</h2>
      <?php
        //query up to 10 recent comments
        $comments_query = "SELECT blog_id, content, time_created FROM comments WHERE user_id=\"".$_GET["userID"]."\" LIMIT 10";
        $comments_result = mysqli_query($db, $comments_query);
        if(mysqli_num_rows($comments_result) != 0) {
          while($r= mysqli_fetch_assoc($comments_result)){
            $comment_blog_query = "SELECT title FROM blogposts WHERE blog_id=\"".$r["blog_id"]."\"";
            $comment_blog_result = mysqli_query($db, $comment_blog_query);
            ?>
            <?php
            echo "<h3><a href=\"blogPiece.php?blogID=".$r["blog_id"]."\">".mysqli_fetch_row($comment_blog_result)[0]."</a></h3>";
            echo "<p style=\"margin-left: 1em\"> - ".$r["content"]."&#9<i>(Created: ".$r["time_created"].")</i></p>";
          }
        }
        else echo "This user hasn't created any comments."
      ?>
  </div>
      <?php
        //admin corner
        //check if profile page belongs to logged in user
        $id_query = "SELECT user_id FROM users WHERE username=\"".$_SESSION['user']."\"";
        $id_result = mysqli_query($db, $id_query);
        if(mysqli_num_rows($id_result) != 0) {
          if($_GET["userID"] == mysqli_fetch_assoc($id_result)['user_id']){
            $admin_query = "SELECT admin_id FROM admins WHERE user_id=".$_GET["userID"]; //check if user already has an admin id
            $admin_result = mysqli_query($db, $admin_query);
            if(mysqli_num_rows($admin_result) != 0) include('./adminProfile.php'); //include admin profile section
            else{
              checkAdminQualification($db); //check if qualified to be admin
            }
          }
        }

        function checkAdminQualification($db){
          $blog_count_query = "SELECT COUNT(*) FROM blogposts WHERE contributor_id=".$_GET["userID"];
          $blog_count_result = mysqli_query($db, $blog_count_query);
          if(mysqli_num_rows($blog_count_result) != 0 && mysqli_fetch_row($blog_count_result)[0] >= 3){ //if more than 3 blog posts
            //turn user into admin
            $admin_qual_query = "INSERT INTO admins (user_id) VALUES(?)";
            $statement = mysqli_prepare($db, $admin_qual_query); //prepare statement

            mysqli_stmt_bind_param($statement, 'i', $userID);
            $userID = $_GET["userID"];

            mysqli_stmt_execute($statement); //execute statement
            mysqli_stmt_close($statement); //close statement

            header("Location: sign-in.php?reg=success");
          }
        }
      ?>
    </div>
  </body>
</html>
