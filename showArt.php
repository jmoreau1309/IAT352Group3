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

		<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
		<script src="./assets/js/showArt.js"></script>
	</head>
	<body>
		<div class="content">
			<h2>Art Pieces</h2>
			<b> Filter by Genre: </b>
			<select name="select_genre" id="select_genre" autocomplete="off">
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
			<ul class="art-list">
			<?php
				//assign entries into array and create for statement that filters by 10s based on GET paremeter
				//shows default first page with no GET parameter, also works with GET['page']=1;
				/*
				while ($row = $res->fetch_assoc()) {
					echo "<li>";
					format_model_name_as_link($row['title'], $row['art_id'],"artDetails.php");
					echo "</li>\n";
				};
				*/
			?>
			</ul>
			<?php
				$res->free_result();
				$db->close();
			?>
		</div>
	</body>
</html>
