<?php
 include('./assets/functions.php');
 require('./data/db.php');
 no_SSL();
?>
<html>
  <?php
    include('header.php');

    if(isset($_GET["blogID"])) $_POST["blogID"] = $_GET["blogID"]; //alt solution for redirect
    else if(!isset($_POST["blogID"])) header("Location: blogFeed.php"); //return to show art page if user access this page without a piece to blog about
    if(!isset($_SESSION["user"])) header("Location: sign-in.php"); //redirect to sign in if user isn't logged in
  ?>
  <head>
    <title>Write Comment</title>
    <link href="./CSS/main.css" rel="stylesheet">
  </head>
  <body>
    <div class="content">
      <?php
        //error message handling
        if(isset($_GET["msg"])){
          switch($_GET["msg"]){
            case "contentempty":
              echo "Please enter blog content.";
              break;
            default:
              break;
          }
        }
      ?>
      <h1> Write Comment </h1>
      <h2>Your Selected Blog Piece:</h2>

      <?php
        $blog_query = "SELECT blogposts.title, blogposts.content, blogposts.blog_id FROM blogposts WHERE blog_id=".$_POST["blogID"];
        $blog_result = mysqli_query($db, $blog_query);
        if (!$blog_result) die("Database query failed."); //test for error

        if(mysqli_num_rows($blog_result) != 0){
          while($r=mysqli_fetch_assoc($blog_result)){
            echo "<b><i>".$r["title"]."</i></b><br/><br/>";
            echo $r["content"]."<br/><br/>";
          }
        }
      ?>

      <form method="post" action="processComment.php">
        <input type="hidden" name="blogID" value="<?php echo $_POST["blogID"]; //art piece id ?>"/>
        <h2 style="margin-bottom: 0;">Content:</h2>
        <textarea name="content" cols="80" rows="10" placeholder="Type out your comment here!"></textarea><br/><br/>
        <input type="submit" value="Submit Comment"/>
      </form>
    </div>
  </body>
</html>
