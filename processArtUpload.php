<?php
include('./assets/functions.php');
no_SSL();
?>
<html>
  <?php include('header.php'); ?>
  <head>
    <title>Process Art Upload</title>
    <link href="./CSS/main.css" rel="stylesheet">
  </head>
  <body>
    <div class="content">
      <?php
      //process artpiece upload
      $art_query = "INSERT INTO artpieces (artist, yearRangeStart, yearRangeEnd, title, genre, description, filename) VALUES(?, ?, ?, ?, ?, ?, ?)";
      $statement = mysqli_prepare($db, $art_query); //prepare statement
      mysqli_stmt_bind_param($statement, 'siissss', $artist, $yrs, $yre, $title, $genre, $desc, $filename);

      if(empty($_FILES["file"]["name"])){ //check if file is empty
        header("Location: uploadArt.php?msg=fileempty");
        exit();
      }
      
      if(!empty($_POST["title"])) $title = $_POST["title"];
      else{
        header("Location: uploadArt.php?msg=titleempty");
        exit();
      }

      if(!empty($_POST["artist"])) $artist = $_POST["artist"];
      else{
        header("Location: uploadArt.php?msg=artempty");
        exit();
      }

      if(!empty($_POST["yearRangeStart"])) $yrs = $_POST["yearRangeStart"];
      else {
        header("Location: uploadArt.php?msg=yrsempty");
        exit();
      }

      $yre = $_POST["yearRangeEnd"]; //year range end is ok to leave empty

      if(!empty($_POST["genre"])) $genre = $_POST["genre"];
      else{
        header("Location: uploadArt.php?msg=genreempty");
        exit();
      }

      $desc = $_POST["description"]; //description can be empty

      //process image upload (last to account for other errors)
      //Resources:
      //https://www.w3schools.com/php/php_file_upload.asp
      //https://www.section.io/engineering-education/managing-file-uploads-in-html-forms-using-php/
      //https://stackoverflow.com/questions/59986082/php-how-to-properly-check-mime-type-of-a-file

      $targetDir = "./assets/img/"; //target directory for upload
      $filename = $_FILES["file"]["name"];
      $targetFile = $targetDir.basename($_FILES["file"]["name"]);
      $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

      $allowedExtentions = array("jpg", "jpeg", "png");
      if(in_array($fileType, $allowedExtentions)) move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile);
      else $err_msg = "File bad.";

      mysqli_stmt_execute($statement); //execute statement
      mysqli_stmt_close($statement); //close statement

      //redirect to art piece
      $artid_query = "SELECT art_id FROM artpieces ORDER BY art_id DESC LIMIT 1"; //new art id is guarenteed to be newest and therefore the largest value
      $artid_result = mysqli_query($db, $artid_query);
      if(mysqli_num_rows($artid_result) != 0) header("Location: artDetails.php?artID=".mysqli_fetch_row($artid_result)[0]);
      else header("Location: showArt.php"); //contingency

      /*
        $art_query = "INSERT INTO artpieces (title, art_id, content, contributor_id) VALUES(?, ?, ?, ?)";
        $statement = mysqli_prepare($db, $blog_query); //prepare statement
        mysqli_stmt_bind_param($statement, 'sisi', $title, $artID, $content, $contributorID);

        //get user ID
        $user_query = "SELECT user_id FROM users WHERE username=\"".$_SESSION["user"]."\"";
        $user_result = mysqli_query($db, $user_query);
        if(mysqli_num_rows($user_result) != 0) $userID = mysqli_fetch_assoc($user_result)["user_id"];
        else header("Location: sign-in.php"); //shouldn't happen, but contingency in case user isn't valid

        //insert parameters
        $title = $_POST["title"];
        $artID = $_POST["artID"];
        $content = $_POST["content"];
        if(isset($userID)) $contributorID = $userID;

        mysqli_stmt_execute($statement); //execute statement
        mysqli_stmt_close($statement); //close statement

        //redirect to blog post
        $blogid_query = "SELECT blog_id FROM blogposts ORDER BY blog_id DESC LIMIT 1"; //new blog post id is guarenteed to be newest and therefore the largest value
        $blogid_result = mysqli_query($db, $blogid_query);
        if(mysqli_num_rows($user_result) != 0) header("Location: blogPiece.php?blogID=".mysqli_fetch_row($blogid_result)[0]);
        else header("Location: blogFeed.php"); //contingency
      */
      ?>
    </div>
  </body>
</html>
