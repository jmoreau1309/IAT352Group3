<?php
function no_SSL() {
	if(isset($_SERVER['HTTPS']) &&  $_SERVER['HTTPS']== "on") {
		header("Location: http://" . $_SERVER['HTTP_HOST'] .
			$_SERVER['REQUEST_URI']);
		exit();
	}
}
function require_SSL() {
	if($_SERVER['HTTPS'] != "on") {
		header("Location: https://" . $_SERVER['HTTP_HOST'] .
			$_SERVER['REQUEST_URI']);
		exit();
	}
}

session_start();
$db =  connectToDB('localhost', 'root', '', 'iat352_final');



function makeHeader($title, $css) {

    echo "<!doctype html>";
    echo "<html lang='en'>";
    echo "<head>";
    echo "<title>$title</title>";
    echo "</head>";
    echo "<body>";
}

if(!empty($_SESSION['valid_user']))  {
    $current_user = $_SESSION['valid_user'];
    //$query = "SELECT * from members WHERE email = '$current_user'";
    //$result = mysqli_query($connection, $query);
    //while($subject = mysqli_fetch_assoc($result)) {
    //    $s_id = $subject['s_id'];
    //    $fname = $subject['firstname'];
    //    $lname = $subject['lastname'];
    //    $faculty = $subject['faculty'];
    //}
}

function redirect_to($url) {
    header('Location: ' . $url);
    exit;
}

function connectToDB($dbhost, $dbuser, $dbpass, $dbname) {
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    //did connection occur database?
    if (mysqli_connect_errno()) {
        //quit and display error and error number
        die("Database connection failed:" .
            mysqli_connect_error() .
            " (" . mysqli_connect_errno() . ")"
        );
    }
    return $connection;
}

function is_logged_in() {
	return isset($_SESSION['valid_user']);
}

function is_in_watchlist($code) {
    global $db;
    if (isset($_SESSION['valid_user'])) {
        $query = "SELECT COUNT(*) FROM watchlist WHERE artID=? AND title=?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('ss',$code, $_SESSION['valid_user']);
        $stmt->execute();
        $stmt->bind_result($count);
        return ($stmt->fetch() && $count > 0);
    }
    return false;
}


function sanitizeInput($var) {
    $var = mysqli_real_escape_string($_SESSION['connection'], $var);
    $var = htmlentities($var);
    $var = strip_tags($var);
    return $var;
}
?>