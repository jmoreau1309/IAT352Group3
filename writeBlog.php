<?php
 include('./assets/functions.php');
 require('./data/db.php');
 no_SSL();
?>
<html>
  <?php
    include('header.php');

    if(isset($_GET["artID"])) $_POST["artID"] = $_GET["artID"]; //alt solution for redirect
    else if(!isset($_POST["artID"])) header("Location: showArt.php"); //return to show art page if user access this page without a piece to blog about
    if(!isset($_SESSION["user"])) header("Location: sign-in.php"); //redirect to sign in if user isn't logged in
  ?>
  <head>
    <title>Write Blog Post</title>
    <link href="./CSS/main.css" rel="stylesheet">
  </head>
  <body>
    <div class="content">
      <?php
        //error message handling
        if(isset($_GET["msg"])){
          switch($_GET["msg"]){
            case "titleempty":
              echo "Please enter a title.";
              break;
            case "contentempty":
              echo "Please enter blog content.";
              break;
            default:
              break;
          }
        }
      ?>
      <h1> Write Blog </h1>
      <h2>Your Selected Art Piece:</h2>

      <?php
        $art_query = "SELECT artpieces.title, artpieces.filename FROM artpieces WHERE art_id=".$_POST["artID"];
        $art_result = mysqli_query($db, $art_query);
        if (!$art_result) die("Database query failed."); //test for error

        if(mysqli_num_rows($art_result) != 0){
          while($r=mysqli_fetch_assoc($art_result)){
            echo "<img src=\"./assets/img/".$r["filename"]."\" class=\"display-img\"/><br/><br/>";
            echo "<i>".$r["title"]."</i><br/>";
          }
        }
      ?>

      <form method="post" action="processBlog.php">
        <input type="hidden" name="artID" value="<?php echo $_POST["artID"]; //art piece id ?>"/>
        <h2 style="margin-bottom: 0;">Title:</h2>
        <input type="text" name="title" value=""/>
        <h2 style="margin-bottom: 0;">Content:</h2>
        <textarea name="content" cols="80" rows="10" placeholder="Type out your blog content here!"></textarea><br/><br/>
        <input class = "button" type="submit" value="Submit Blog"/>
      </form>
    </div>
  </body>
</html>
