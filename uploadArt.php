<?php
include('./assets/functions.php');
no_SSL();
?>
<html>
  <?php
    include('header.php');
    if(!isset($_SESSION['user'])) header("Location: index.php");
    $adminid_query = "SELECT admin_id FROM admins WHERE user_id=(SELECT user_id FROM users WHERE username=\"".$_SESSION['user']."\")";
    $adminid_result = mysqli_query($db, $adminid_query);
    if(mysqli_num_rows($adminid_result) == 0) header("Location: index.php");
  ?>
  <head>
    <title>Upload Art Piece</title>
    <link href="./CSS/main.css" rel="stylesheet">
  </head>
  <body>
    <div class="content">
      <?php
        //error message handling
        if(isset($_GET["msg"])){
          switch($_GET["msg"]){
            case "fileempty":
              echo "Please upload an image.";
              break;
            case "titleempty":
              echo "Please enter a title.";
              break;
            case "artempty":
              echo "Please enter an artist.";
              break;
            case "yrsempty":
              echo "Please enter a start year.";
              break;
            case "genreempty":
              echo "Please enter a genre.";
              break;
            default:
              break;
          }
        }
      ?>
      <h1>Upload Image</h1>
      <form method="post" action="processArtUpload.php" enctype="multipart/form-data">
        <h2 style="margin-bottom: 0;">Upload Art Piece</h2>
        <input type="file" name="file" accept="image/*">

        <h2 style="margin-bottom: 0;">Title:</h2>
        <input type="text" name="title" value=""/>

        <h2 style="margin-bottom: 0;">Artist:</h2>
        <input type="text" name="artist" value=""/>

        <h2 style="margin-bottom: 0;">Year Range:</h2>
        Start: <input type="number" name="yearRangeStart" value="" max="10000"/> <br/>
        End: <input type="number" name="yearRangeEnd" value="" max="10000"/>

        <h2 style="margin-bottom: 0;">Genre:</h2>
        <input type="text" name="genre" value=""/>

        <h2 style="margin-bottom: 0;">Description:</h2>
        <textarea name="description" cols="80" rows="10" placeholder="Type out your description here!"></textarea><br/><br/>

        <input type="submit" value="Submit Art Piece"/>
      </form>
    </div>
  </body>
</html>
