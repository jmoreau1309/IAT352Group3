<html>
<link rel="stylesheet" href="css/main.css">
<div class="header">
  <a href="#default" class="logo">Art Blogger</a>
  <div class="header-right">
    <a class="active" href="#home">Main Feed</a>
    <a href="#genres">Art Genres</a>
  </div>
		<?php
		if (isset($_SESSION['valid_user']))
			echo "<a class=\"nav\"  href=\"sign-out.php\">Sign out</a>";
		else
			echo "<a class=\"nav\" href=\"sign-in.php\">Sign In</a>";
		?>
	</div>
</html>
<!--header ends here-->
