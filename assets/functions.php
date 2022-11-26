<?php
function require_ssl(){
  if($_SERVER['HTTPS'] != "on") {
  	header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
  	exit();
  }
}

function no_ssl(){
  if(isset($_SERVER['HTTPS'])) {
  	header("Location: http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
  	exit();
  }
}
?>
