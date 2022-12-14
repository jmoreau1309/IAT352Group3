<?php
include('./functions.php');

filterArtByGenre($_POST['filter_genre']);

function filterArtByGenre($value){
  $db =  connectToDB('localhost', 'root', '', 'iat352_final');

  if(!empty($_POST['filter_genre'])) $filter_query_str = "SELECT title, art_id, artist, yearRangeStart, yearRangeEnd filename FROM artpieces WHERE genre=\"".$value."\"";
  else $filter_query_str = "SELECT title, art_id, artist, yearRangeStart, yearRangeEnd, filename FROM artpieces";

  $stmt = $db->prepare($filter_query_str);
  $stmt->execute();
  $stmt->bind_result($title, $art_id, $artist, $yearRangeStart, $yearRangeEnd, $filename);

  $result = array();

  while($stmt->fetch()){
      $result[] = array(
          "title"=>$title,
          "art_id" => $art_id,
          "artist" => $artist,
          "yearRangeStart" => $yearRangeStart,
          "yearRangeEnd" => $yearRangeEnd,
          "filename" => $filename
        );
  }
  echo json_encode($result);
}
?>
