<?php
 include('./assets/functions.php');
 no_SSL();
?>
<html>
  <?php include('header.php'); ?>
  <head>
    <title>Process Comment</title>
    <link href="./CSS/main.css" rel="stylesheet">
  </head>
  <body>
    <?php
      $cmt_query = "INSERT INTO comments (blog_id, user_id, content) VALUES(?, ?, ?)";
      $statement = mysqli_prepare($db, $cmt_query); //prepare statement
      mysqli_stmt_bind_param($statement, 'iis', $blogID, $userID, $content);

      //get user ID
      $user_query = "SELECT user_id FROM users WHERE username=\"".$_SESSION["user"]."\"";
      $user_result = mysqli_query($db, $user_query);
      if(mysqli_num_rows($user_result) != 0) $userID = mysqli_fetch_assoc($user_result)["user_id"]; //set user id
      else header("Location: sign-in.php"); //shouldn't happen, but contingency in case user isn't valid

      //insert parameters
      if(isset($_POST["blogID"])) $blogID = $_POST["blogID"];
      else{
        header("Location: blogFeed.php"); //case shouldn't happen, but contingency
        exit();
      }

      if(isset($_POST["content"])) $content = $_POST["content"];
      else{
        header("Location: writeComment.php?msg=contentempty&blogID=".$_POST["blogID"]);
        exit();
      }

      mysqli_stmt_execute($statement); //execute statement
      mysqli_stmt_close($statement); //close statement

      //redirect to blog post
      header("Location: blogFeed.php?blogID=".$_POST["blogID"]); //contingency
    ?>
  </body>
</html>
