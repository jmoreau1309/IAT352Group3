<?php
include('included_functions.php');
no_SSL();

$code = trim($_GET['artID']);
@$msg = trim($_GET['message']);

$query_str = "SELECT * 
              FROM artpieces
              WHERE title = ?"; 
              
$stmt = $db->prepare($query_str);
$stmt->bind_param('s',$code);
$stmt->execute();
$stmt->bind_result($title,$artist,$yearRangeStart,$yearRangeEnd,$genre,$description);;

include('header.php');

if($stmt->fetch()) {
    echo "<h3>$prName</h3>\n";
    echo "<p>Category: $title,$artist,$yearRangeStart,$yearRangeEnd,$genre</p>\n";
    echo "<p>Description: $descripton</p>\n";
    }
$stmt->free_result();

$db->close();
?>