<?php
require('function_library.php');
session_start();

if(isset($_SESSION['id']) && $_SESSION['name']){
  $id = $_SESSION['id'];
  $name = $_SESSION['name'];
}else{
  header('Location: login.php');
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
    <h1>Work Out Provider</h1>
  </header>

  <div class="thanks">
    <img src="./images/thanks.png" alt="ばいばいする写真">
    <div class='thanksletter'>
      <h2>今日もお疲れ様でした。</h2>
      <h4>よくがんばりましたね</h4>
      <div class="select">
        <a href="note.php">
          <div class="border-radius2">
            <img src="./images/note.png" alt="">
            <p class="thanks-content">記録を見る</p>
          </div>
        </a>
        <a href="home.php">
          <div class="border-radius2">
            <img src="./images/HOME.png" alt="">
            <p class="thanks-content">ホーム画面へ</p>
          </div>
        </a>
      </div>
    </div>
  </div>
</body>
</html>