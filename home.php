<?php
session_start();
require('function_library.php');


if(isset($_SESSION['id']) && $_SESSION['name']){
  $id = $_SESSION['id'];
  $name = $_SESSION['name'];
}else{
  header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
</head>
<body>
  <header>
    <a href="home.php"><img src="./images/logo.png" alt="ロゴの写真" class="logo-img"></a>
    <div class='logout-header'>
      <h1>Work Out Provider</h1>
      <div class="logout">
        <a href="logout.php">
          <img src="./images/logout.png" alt="">
        </a>
      </div>
    </div>
  </header>
  <div class="intro">
    <p>筋トレを始めたけど</p>
    <p>なにをしたらいいかわからないあなたへ</p>
  </div>

  <div class="contents">
    <a href="select_work.php">
      <div class="border-radius">
        <img src="./images/body.png" alt="">
        <p class="content">トレーニング</p>
      </div>
    </a>
    <a href="note.php">
      <div class="border-radius">
        <img src="./images/note.png" alt="">
        <p class="content">記録</p>
      </div>
    </a>
    <a href="question.php">
      <div class="border-radius">
        <img src="./images/Q&A.png" alt="">
        <p class="content">Q&A</p>
      </div>
    </a>
  </div>
</body>
</html>