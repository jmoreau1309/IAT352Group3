<html>
<head>
<title>Art Genre Blog Site</title>
<style>
a.nav { color:white; text-decoration: none;}
li a.action { text-decoration: none; font-size: 70% }
</style>

</head>
<body>
<table style="width:100%;border-spacing:0px">
<tr style="height:100px;background-color:#FFFFFF">
<th style="font-family:arial;font-size:66px;color:black;text-align:center">Art Genre Blog Site</th>
</tr>
<tr height="30" bgcolor="#02198B">
<td style="font-family:arial;font-size:24px;color:white;">
<strong><a class="nav"  href="showArt.php">Art Pieces</a> |
<a class="nav" href="blogFeed.php">Blog Feed</a> |
<?php 
if (isset($_SESSION['valid_user']))
	echo "<a class=\"nav\"  href=\"sign-out.php\">Sign out</a>";
else 
	echo "<a class=\"nav\" href=\"sign-in.php\">Sign In</a>";
?>
</td>
<tr bgcolor="FFFFFF">
<td >
<!--header ends here-->




