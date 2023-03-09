<?php
  session_start();
  require('function_library.php');


  $error=[];
  $name = '';
  $password = '';

  //フォーム内容のチェック
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = filter_input(INPUT_POST,'name', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_STRING);
    if($name ==='' || $password === ''){
      $error['login'] = 'blank';
    }else{
      $db = dbconnect();
      $stmt = $db->prepare('select id,password from members where name=? limit 1');
      if(!$stmt){
        $db->error;
      }
      $stmt->bind_param('s', $name);
      $success = $stmt->execute();
      if(!$success){
        $db->error;
      }
      $stmt->bind_result($id, $hash);
      $stmt->fetch();

      if(password_verify($password, $hash)){
        session_regenerate_id();
        $_SESSION['id'] = $id;
        $_SESSION['name'] = $name;
        header('Location: home.php');
        exit();
      }else{
        $error['login'] = 'failed';
      }
    }
  }
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Login</title>
</head>
<body>
  <header>
    <?php include("header.html") ?>
  </header>
  <main>
    <a href="./signin.php"><p class="create_account">初めての方はこちら</p></a>
    <h2 class="sign-in">ログイン</h2>
    <form action="" method="post">
      <dl>
        <dt>ニックネーム<span class="required">※必須</span></dt>
          <dd>
            <input type="text" name="name"  class = "user_info"  maxlength="255"  placeholder="名前を入力してください" value="<?php echo h($name); ?>"/>
            <?php if(isset($error['login']) && $error['login'] === 'blank'): ?>
              <p class="error" style="color : red;">* ニックネームまたはパスワードが記入されていません</p>
            <?php endif; ?>
          </dd>
        <dt>パスワード<span class="required">※必須</span></dt>
          <dd>
          <input type="password" name="password" class = "user_info"  maxlength="255" value="<?php echo h($password); ?>" placeholder="パスワードを入力してください"/>
          <?php if(isset($error['login']) && $error['login'] === 'failed'): ?>
            <p class='error' style="color : red;">* ログイン失敗 正しく記入してください。</p>
          <?php endif; ?>
          </dd>
      </dl>
      <div>
        <input type="submit" value="ログイン" class="create_user">
      </div>
    </form>
  </main>
</body>
</html>