<?php
//require('header.php');

include('./assets/functions.php');
no_SSL();

$query_str = "SELECT title, art_id, artist, yearRangeStart, yearRangeEnd FROM artpieces";
$res = $db->query($query_str);

function format_model_name_as_link($title, $artID, $page) {
	echo "<a href=\"$page?artID=$artID\">$title,$artID</a>";
}

include('header.php');


echo "<h2>All Art</h2>";

echo "<ul>";
while ($row = $res->fetch_assoc()) {
	echo "<li>";
	format_model_name_as_link($row['title'], $row['art_id'],"artDetails.php");
	echo "</li>\n";
};
echo "</ul>";

$res->free_result();
$db->close();

?>
