<?php
session_start();
require('function_library.php');

if(isset($_GET['part']) && $_GET['part'] === 'chest'){
  echo '胸';
}

if(isset($_GET['part']) && $_GET['part'] === 'back'){
  echo '背中';
}

if(isset($_GET['part']) && $_GET['part'] === 'leg'){
  echo '脚';
}

if(isset($_GET['part']) && $_GET['part'] === 'sholder'){
  echo '肩';
}

if(isset($_GET['part']) && $_GET['part'] === 'arm'){
  echo '腕';
}
?>