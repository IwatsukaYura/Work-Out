<?php
session_start();
require('function_library.php');
require('training_set.php');

if(isset($_SESSION['id']) && $_SESSION['name']){
  $id = $_SESSION['id'];
  $name = $_SESSION['name'];
}else{
  header('Location: index.php');
}

if(isset($_GET['part']) && $_GET['part'] === 'chest'){
  $chest_training = return_chest_training();
  $training_explain = return_chest_training_explain();
  $training = select_random_training($chest_training);
}

if(isset($_GET['part']) && $_GET['part'] === 'back'){
  $back_training = return_back_training();
  $training_explain = return_back_training_explain();
  $training = select_random_training($back_training);
}

if(isset($_GET['part']) && $_GET['part'] === 'leg'){
  $leg_training = return_leg_training();
  $training_explain = return_leg_training_explain();
  $training = select_random_training($leg_training);
}

if(isset($_GET['part']) && $_GET['part'] === 'sholder'){
  $sholder_training = return_sholder_training();
  $training_explain = return_sholder_training_explain();
  $training = select_random_training($sholder_training);
}

if(isset($_GET['part']) && $_GET['part'] === 'arms'){
  $arm_training = return_arm_training();
  $training_explain = return_arm_training_explain();
  $training = select_random_training($arm_training);
}


if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $fit1 = $_POST['fit1'];
  $fit2 = $_POST['fit2'];
  $fit3 = $_POST['fit3'];

  $db = dbconnect();
  $stmt = $db->prepare('insert into fitness (user_name, fit1, fit2, fit3) value (?,?,?,?)');
  if(!$stmt){
    die($db->error);
  }
  $stmt->bind_param('ssss', $name, $fit1, $fit2, $fit3);
  $success = $stmt->execute();
  if(!$success){
    die($db->error);
  }

  header('Location: thanks.php');

}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Training</title>
</head>
<body>
  <header>
    <a href="select_work.php"><img src="./images/logo.png" alt="ロゴの写真" class="logo-img"></a>
    <h1>Work Out Provider</h1>
  </header>
  <a href="select_work.php">←戻る</a>
  <br>
  <br>
  <div class="feature">
      <div class="feature-text">
        <?php $training_name =$training[0]; ?>
        <h2><?php echo $training_name ?></h2>
        <p><?php echo $training_explain[$training_name] ?></p>
      </div>
      <img src="./images/work1.png" alt="運動1">
  </div>
  <div class="feature reverse">
  <div class="feature-text">
        <?php $training_name =$training[1]; ?>
        <h2><?php echo $training_name ?></h2>
        <p><?php echo $training_explain[$training_name] ?></p>
      </div>
      <img src="./images/work2.png" alt="運動1">
  </div>
  <div class="feature">
      <div class="feature-text">
        <?php $training_name =$training[2]; ?>
        <h2><?php echo $training_name ?></h2>
        <p><?php echo $training_explain[$training_name] ?></p>
      </div>
      <img src="./images/work3.png" alt="運動1">
  </div>
  
  <form action="" method="POST">
    <input type="hidden" value=<?php echo $training[0] ?> name="fit1">
    <input type="hidden" value=<?php echo $training[1] ?> name="fit2">
    <input type="hidden" value=<?php echo $training[2] ?> name="fit3">
    <input type="hidden" value=<?php echo $id ?> name="id">
    <input type="hidden" value=<?php echo $name ?> name="name">
    <input type="submit" value='トレーニング完了' class="rounded-corner">
    
  </form>

</body>
</html>