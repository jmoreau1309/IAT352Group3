<html>
<link rel="stylesheet" href="css/main.css">
<div class="header">
  <a href="index.php" class="logo">Art Blogger</a>
  <div class="header-right">
    <a class="active" href="showArt.php">Main Feed</a>
    <a href="#genres">Art Genres</a>
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
