<html>
<link rel="stylesheet" href="css/main.css">
<div class="header">
  <a href="index.php" class="logo">Art Blogger</a>
  <div class="header-right">
    <a class="button" href="showArt.php">Main Art Feed</a>
    <a class="button" href="blogFeed.php">Blog Feed</a>
    <?php
      if(isset($_SESSION['user'])) echo "<a class=\"button\" href=\"profile.php?username=".$_SESSION['user']."\">Profile</a>";
      else echo "<a class=\"button\" href=\"profile.php\">Profile</a>";
    ?>
  </div>
		<?php
		if (isset($_SESSION['user']))
			echo "<a class=\"nav\"  href=\"sign-out.php\">Sign out</a> <p class=\"user-text\"> &nbsp&nbsp Welcome, ".$_SESSION['user']."!</p>";
		else
			echo "<a class=\"nav\" href=\"sign-in.php\">Sign In</a>";
		?>
	</div>
</html>
<!--header ends here-->
