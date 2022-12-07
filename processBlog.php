<?php
 include('./assets/functions.php');
 no_SSL();
?>
<html>
  <?php include('header.php'); ?>
  <head>
    <title>Process Blog Post</title>
    <link href="./CSS/main.css" rel="stylesheet">
  </head>
  <body>
    <?php
      $blog_query = "INSERT INTO blogposts (title, art_id, content, contributor_id) VALUES(?, ?, ?, ?)";
      $statement = mysqli_prepare($db, $blog_query); //prepare statement
      mysqli_stmt_bind_param($statement, 'sisi', $title, $artID, $content, $contributorID);

      //get user ID
      $user_query = "SELECT user_id FROM users WHERE username=\"".$_SESSION["user"]."\"";
      $user_result = mysqli_query($db, $user_query);
      if(mysqli_num_rows($user_result) != 0) $userID = mysqli_fetch_assoc($user_result)["user_id"];
      else header("Location: sign-in.php"); //shouldn't happen, but contingency in case user isn't valid

      //insert parameters
      if(isset($_POST["artID"])) $artID = $_POST["artID"];
      else{
        header("Location: showArt.php"); //case shouldn't happen, but contingency
        exit();
      }

      if(!empty($_POST["title"])) $title = $_POST["title"];
      else{
        header("Location: writeBlog.php?msg=titleempty&artID=".$_POST["artID"]);
        exit();
      }

      if(!empty($_POST["content"])) $content = $_POST["content"];
      else{
        header("Location: writeBlog.php?msg=contentempty&artID=".$_POST["artID"]);
        exit();
      }

      if(isset($userID)) $contributorID = $userID;
      else {
        header("Location: sign-in.php"); //shouldn't happen, but contingency
        exit();
      }

      mysqli_stmt_execute($statement); //execute statement
      mysqli_stmt_close($statement); //close statement

      //redirect to blog post
      $blogid_query = "SELECT blog_id FROM blogposts ORDER BY blog_id DESC LIMIT 1"; //new blog post id is guarenteed to be newest and therefore the largest value
      $blogid_result = mysqli_query($db, $blogid_query);
      if(mysqli_num_rows($blogid_result) != 0) header("Location: blogPiece.php?blogID=".mysqli_fetch_row($blogid_result)[0]);
      else header("Location: blogFeed.php"); //contingency
    ?>
  </body>
</html>
