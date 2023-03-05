<?php
  session_start();
  require('../function_library.php');

  if(isset($_SESSION['form'])){
    $form = $_SESSION['form'];
  }else{
    header('Location: admin_signin.php');
    exit();
  }
  
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $db = dbconnect();
    if(!$db){
      die($db->error);
    }
    $stmt = $db->prepare('insert into admin_members (name, password) values (?,?)');
    if(!$stmt){
      die($db->error);
    }
    $password = password_hash($form['password'], PASSWORD_DEFAULT);
    $stmt->bind_param('ss', $form['name'], $password);
    $success = $stmt->execute();
    if(!$success){
      die($db->error);
    }
  
    unset($_SESSION['form']);
    header('Location: admin_login.php');
  
  }
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <title>Signin</title>
</head>
<body>
  <header>
    <a href="admin_login.php"><img src="../images/logo.png" alt="ロゴの写真" class="logo-img"></a>
    <h1>Work Out Provider</h1>
  </header>
  <main>
    <div class="confirm">
    <a href="admin_signin.php?action=rewrite">&laquo;&nbsp;書き直す</a>
      <h2 class="sign-in">管理者登録　確認画面</h2>
      <p class='confirm_text'>記入した内容を確認して、「ユーザ作成」ボタンをクリックしてください</p>
      <form action="" method="post">
        <dl>
          <dt>ニックネーム</dt>
            <dd><?php echo h($form['name']) ?></dd>
          <dt>パスワード</dt>
            <dd><?php echo str_repeat('*', strlen($form['password'])) ?></dd>
        </dl>
        <div>
          <input type="submit" value="ユーザ作成" class="create_user">
        </div>
      </form>
    </div>
  </main>
</body>
</html>
