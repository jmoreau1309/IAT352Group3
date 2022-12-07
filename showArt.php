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
		<script src="./assets/js/showArt.js"></script>
	</head>
	<body>
		<div class="content">
			<h2>All Art Pieces</h2>
			<b> Filter by Genre: </b>
			<select name="genre" id="genre">
				<option value="">None</option>
				<?php
					$genre_query = "SELECT DISTINCT genre FROM artpieces";
					$genre_result = mysqli_query($db, $genre_query);
					if(mysqli_num_rows($genre_result) != 0) {
						while($r= mysqli_fetch_assoc($genre_result)){
							echo "<option value=\"".$r['genre']."\">".formatGenreInput($r['genre'])."</option>";
						}
					}
				?>
			</select>
			<?php
				//assign entries into array and create for statement that filters by 10s based on GET paremeter
				//shows default first page with no GET parameter, also works with GET['page']=1;
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
