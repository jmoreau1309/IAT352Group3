<?php
 require('header.php');
 require('./data/db.php');
 require('./assets/functions.php');
 ?>
<html>
    <link href="./CSS/main.css" rel="stylesheet">
    <div class="content">
<div class="container padding-32">
<h2>Edit Account Info</h2>
<form action="processProfileUpdate.php" method="post">
        Username: <br/>
        <input type="text" name="username" value=""/><br/><br/>
        Email: <br/>
        <input type="text" name="email" value=""/><br/><br/>
        Password:  <br/>
        <input type="password" name="pass" value=""/><br/><br/>
        Confirm Password:  <br/>
        <input type="password" name="check_pass" value=""/><br/><br/>

        <input class = "button" type="submit" value="Confirm Update">
   
</form>
</div>
</div>
</html>
