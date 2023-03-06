<?php
session_start();
require('function_library.php');

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
  <link rel="stylesheet" href="./style.css">
  <title>Work Out Provider</title>
</head>
<body>
  <header>
    <a href="home.php"><img src="./images/logo.png" alt="ロゴの写真" class="logo-img"></a>
    <h1>Work Out Provider</h1>
  </header>
  <a href="home.php">←戻る</a>
  <br>
  <br>
  <div>
    <h2 class="training">トレーニングしたい部位を選択してください</h2>
  </div>
  <ul class="select_work">
    <div>
      <a href="training.php?part=chest"><li><img src="./images/筋肉1.png" alt="筋肉の画像"></li></a>
      <p>胸</p>
    </div>
    <div>
      <a href="training.php?part=back"><li><img src="./images/筋肉2.png" alt="筋肉の画像"></li></a>
      <p>背中</p>
    </div>
    <div>
      <a href="training.php?part=leg"><li><img src="./images/筋肉3.png" alt="筋肉の画像"></li></a>
      <p>脚</p>
    </div>
    <div>
      <a href="training.php?part=sholder"><li><img src="./images/筋肉4.png" alt="筋肉の画像"></li></a>
      <p>肩</p>
    </div>
    <div>
    <a href="training.php?part=arms"><li><img src="./images/筋肉5.png" alt="筋肉の画像"></li></a>
      <p>腕</p>
    </div>
  </ul>
</body>
</html>