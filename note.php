<?php
require('function_library.php');
session_start();

if(isset($_SESSION['id']) && $_SESSION['name']){
  $id = $_SESSION['id'];
  $name = $_SESSION['name'];
}else{
  header('Location: index.php');
}

$db=dbconnect();
$stmt = $db->prepare('select count(*) from fitness where user_name=?');

if(!$stmt){
  die($db->error);
}

$stmt->bind_param('s', $name);
$success = $stmt->execute();

if(!$success){
  die($db->error);
}

$stmt->bind_result($total_days);
$stmt->fetch();

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
  <a href="home.php">←戻る</a>
  <br>
  <br>
  <?php
    $db=dbconnect();
    $stmt = $db->prepare('select fit1,fit2,fit3,time from fitness where user_name=?');

    if(!$stmt){
      die($db->error);
    }

    $stmt->bind_param('s', $name);
    $success = $stmt->execute();

    if(!$success){
      die($db->error);
    }
    $stmt->bind_result($fit1,$fit2,$fit3,$time);
  ?> 
  <?php for($i=0;$i<$total_days;$i++):?>
    <?php $stmt->fetch(); ?>
    <div class="qa_contents">
      <div class="QA">
        <details class="qa-008">
          <summary><?php echo mb_substr($time, 0 , 10); ?></summary>
          <br>
          <p><?php echo $fit1; ?></p>
          <p><?php echo $fit2; ?></p>
          <p><?php echo $fit3; ?></p>
        </details>
      </div>
    </div>
  <?php endfor;?>
</body>
</html>