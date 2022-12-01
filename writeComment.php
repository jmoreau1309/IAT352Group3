<?php
 include('./assets/functions.php');
 require('./data/db.php');
 no_SSL();
?>
<html>
  <?php
    include('header.php');

    if(!isset($_POST["blogID"])) header("Location: blogFeed.php"); //return to show art page if user access this page without a piece to blog about
    if(!isset($_SESSION["user"])) header("Location: sign-in.php"); //redirect to sign in if user isn't logged in
  ?>
  <head>
    <title>Write Comment</title>
    <link href="./CSS/main.css" rel="stylesheet">
  </head>
  <body>
    <div class="content">
      <!--placeholder for form to fill out-->
      <h1> Write Comment </h1>
      <h2>Your Selected Blog Piece:</h2>

      <?php
        $blog_query = "SELECT blogposts.title, blogposts.content, blogposts.blog_id FROM blogposts WHERE blog_id=".$_POST["blogID"];
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
        <input type="submit" value="Submit Blog"/>
      </form>
    </div>
  </body>
</html>
