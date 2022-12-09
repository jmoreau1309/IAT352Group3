<?php
 require('header.php');
 require('./data/db.php');
 require('./assets/functions.php');
 require_ssl();
?>
<html>
  <?php
  //code largely recycled from Herman's A4
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      //check for valid user
      //check if user already exists
      $users_query = "SELECT users.password, users.username FROM users WHERE email=?";

      //prepare statement to prevent sql injection
      $users_statement = mysqli_prepare($db, $users_query); //prepare statement
      mysqli_stmt_bind_param($users_statement, 's', $_POST["user"]);
      mysqli_stmt_execute($users_statement); //execute statement
      $users_result = mysqli_stmt_get_result($users_statement); //get query result

      if(mysqli_num_rows($users_result) != 0) {
        while($r = mysqli_fetch_assoc($users_result)){
          //check input password against database password
          $pass_hash = hash('sha256', $_POST["pass"]); //turn current password into hash
          $db_pass = $r["password"];

          if($pass_hash == $db_pass) $_SESSION['user'] = $r["username"];
          else $msg = "Incorrect password. Please try again.";
        }
      }
      else $msg = "Invalid user. Please try again.";
    }
  ?>

  <head>
    <title>Sign In</title>
    <link href="./CSS/main.css" rel="stylesheet">
  </head>

  <body>
    <div class="content">
      <?php
        //return to designated URL if signed in and has valid url return location,otherwise return to index page
        if(isset($_SESSION['user']) && isset($_SESSION["return_to_url"]))
          header("Location: http://". $_SERVER['HTTP_HOST'] . $_SESSION["return_to_url"]);
        else if (isset($_SESSION['user'])) header("Location: index.php");

        //echo messages
        if(isset($_GET["reg"]) && $_GET["reg"]=="success") echo "<br/> Registration Successful.";
        if(isset($msg)) echo "<br/>".$msg;
      ?>
      <form method="post" action="sign-in.php">
        <h2>Log In:</h2>
        Email: <br/>
        <input type="text" name="user" value=""/><br/><br/>
        Password:  <br/>
        <input type="password" name="pass" value=""/><br/><br/>
        <input class = "button" type="submit" value="Log In">
      </form>
      <br/>
      Not a user? Register <a href="register.php">Here.</a>
    </div>
  </body>
</html>
