<?php
 require('header.php');
 require('./data/db.php');
 require('./assets/functions.php');
 require_ssl();
?>
<html>
  <?php
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); //connect to db
    if(mysqli_connect_errno()) die(mysqli_connect_error()); //test for successful connection

    if($_SERVER['REQUEST_METHOD'] == 'POST') {//if input fields are POSTed
      //check for valid entry
      if(isset($_POST["username"]) && isset($_POST["email"])
        && isset($_POST["pass"]) && isset($_POST["check_pass"])){
        if($_POST["pass"] == $_POST["check_pass"]) checkRegistration($connection, $msg);
        else $msg = "Passwords do not match. Please try again."; //error case when password fields don't match
      }
      //error cases for unentered fields
      else if(!isset($_POST["username"])) $msg = "Please enter your username.";
      else if(!isset($_POST["email"])) $msg = "Please enter your email.";
      else if(!isset($_POST["pass"]) || !isset($_POST["check_pass"])) $msg = "Please enter both password fields.";
      else $msg = "Registration failed. Please try again."; //other undetectable cases
    }

    function checkRegistration($connection, &$msg){
      //check if email already exists
      $email_query = "SELECT users.email FROM users WHERE email=?";

      //prepare statement to prevent sql injection
      $email_statement = mysqli_prepare($connection, $email_query); //prepare statement
      mysqli_stmt_bind_param($email_statement, 's', $_POST["email"]);
      mysqli_stmt_execute($email_statement); //execute statement
      $email_result = mysqli_stmt_get_result($email_statement); //get query result

      //check if email already exists
      $users_query = "SELECT users.username FROM users WHERE username=?";

      //prepare statement to prevent sql injection
      $users_statement = mysqli_prepare($connection, $users_query); //prepare statement
      mysqli_stmt_bind_param($users_statement, 's', $_POST["username"]);
      mysqli_stmt_execute($users_statement); //execute statement
      $users_result = mysqli_stmt_get_result($users_statement); //get query result

      if(mysqli_num_rows($email_result) > 0) $msg = "Email already exists. Please try again.";
      else if(mysqli_num_rows($users_result) > 0) $msg = "Username already exists. Please try again.";
      else{
        //insert new user into database
        $insert_query = "INSERT INTO users (username, email, password) VALUES(?, ?, ?)";
        $statement = mysqli_prepare($connection, $insert_query); //prepare statement
        mysqli_stmt_bind_param($statement, 'sss', $email, $user, $pass);

        //create password hash
        $pass_hash = hash('sha256', $_POST["pass"]);

        //set parameters to bind
        $email = $_POST["email"];
        $user = $_POST["username"];
        $pass = $pass_hash;

        mysqli_stmt_execute($statement); //execute statement
        mysqli_stmt_close($statement); //close statement

        header("Location: sign-in.php?reg=success");
      }
    }
  ?>
  <head>
    <title>All Models</title>
    <link href="./CSS/main.css" rel="stylesheet">
  </head>

  <body>
    <div class="content">
      <form method="post" action="register.php">
        <h2>Register:</h2>
        Username: <br/>
        <input type="text" name="username" value=""/><br/><br/>
        Email: <br/>
        <input type="text" name="email" value=""/><br/><br/>
        Password:  <br/>
        <input type="password" name="pass" value=""/><br/><br/>
        Confirm Password:  <br/>
        <input type="password" name="check_pass" value=""/><br/><br/>
        <?php if(isset($msg)) echo $msg."<br/>"; //error message?><br/><br/>
        <input type="submit" value="Register">
      </form>
    </div>
  </body>
</html>
