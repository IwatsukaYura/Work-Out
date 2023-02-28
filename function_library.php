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

//トレーニングメニューからランダムで3つ抽出して、表示する
function select_random_training($trainig){
  $value = [];
  $i=0;
  $keys = array_rand($trainig, 3);
  foreach($keys as $key){
    $value[$i] = $trainig[$key];
    $i++;
  }
  return $value;
}

?>
