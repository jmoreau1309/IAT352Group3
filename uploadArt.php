<?php
include('./assets/functions.php');
no_SSL();
?>
<html>
  <?php include('header.php'); ?>
  <head>
    <title>Upload Art Piece</title>
    <link href="./CSS/main.css" rel="stylesheet">
  </head>
  <body>
    <div class="content">
      <h1>Upload Image</h1>
      <form method="post" action="processArtUpload.php">
        <h2 style="margin-bottom: 0;">Upload Art Piece</h2>
        <h2 style="margin-bottom: 0;">Title:</h2>
        <input type="text" name="title" value=""/>
        <h2 style="margin-bottom: 0;">Content:</h2>
        <textarea name="content" cols="80" rows="10" placeholder="Type out your blog content here!"></textarea><br/><br/>
        <input type="submit" value="Submit Blog"/>
      </form>
    </div>
  </body>
</html>
