<?php

/* htmlspecilcharsを短くする */
function h($value){
  return htmlspecialchars($value, ENT_QUOTES);
}
//DBへの接続
function dbconnect(){
  $db = new mysqli('localhost:9000', 'root', 'root', 'work_out'); 
  if(!$db){
		die($db->error);
	}
  
  return $db;
}

?>
