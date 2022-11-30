<?php
	include('./assets/functions.php');
	no_SSL();

	$query_str = "SELECT title, art_id, artist, yearRangeStart, yearRangeEnd FROM artpieces";
	$res = $db->query($query_str);

	function format_model_name_as_link($title, $artID, $page) {
		echo "<a href=\"$page?artID=$artID\">$title</a>";
	}
?>
<html>
	<?php
		include('header.php');
		$_SESSION["return_to_url"] = $_SERVER['REQUEST_URI'];
	?>
	<head>
		<title> All Art Pieces </title>
		<link href="./CSS/main.css" rel="stylesheet">
	</head>
	<body>
		<div class="content">
			<?php
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
		</div>
	</body>
</html>
