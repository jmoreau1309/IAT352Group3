<?php
include('./functions.php');

filterArtByGenre($_POST['filter_genre']);

function filterArtByGenre($value){
  $db =  connectToDB('localhost', 'root', '', 'iat352_final');

  if(!empty($_POST['filter_genre'])) $filter_query_str = "SELECT title, art_id, artist, yearRangeStart, yearRangeEnd FROM artpieces WHERE genre=\"".$value."\"";
  else $filter_query_str = "SELECT title, art_id, artist, yearRangeStart, yearRangeEnd FROM artpieces";

  $stmt = $db->prepare($filter_query_str);

  $stmt->execute();
  $stmt->bind_result($title, $art_id, $artist, $yearRangeStart, $yearRangeEnd);

  $result = array();

  while($stmt->fetch()){
      $result[] = array(
          "title"=>$title,
          "art_id" => $art_id,
          "artist" => $artist,
          "yearRangeStart" => $yearRangeStart,
          "yearRangeEnd" => $yearRangeEnd);
  }
  echo json_encode($result);
}
?>
