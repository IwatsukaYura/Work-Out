<?php
  session_start();
  require('function_library.php');

  if(isset($_GET['action']) && $_GET['action'] === 'rewrite' && isset($_SESSION['form'])){
    $form = $_SESSION['form'];
} else{
    $form = [
        'name' => '',
        'password' => '',
    ];
}


  $error=[];
  //フォーム内容のチェック
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $form['name'] = filter_input(INPUT_POST,'name', FILTER_SANITIZE_STRING);
    if($form['name'] === ''){
      $error['name'] = 'blank';
    }

    $form['password'] = filter_input(INPUT_POST,'password', FILTER_SANITIZE_STRING);
    if($form['password'] === ''){
      $error['password'] = 'blank';
    }
    else if(strlen($form['password']) < 4){
      $error['password'] = 'length';
    }

    if(empty($error)){
      $_SESSION['form'] = $form;

      header('Location: select_work.php');
      exit();
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
            <input type="text" name="name"  style="width: 400px; height: 65px;" maxlength="255"  placeholder="名前を入力してください" value="<?php echo h($form['name']); ?>"/>
            <?php if(isset($error['name']) && $error['name'] === 'blank'): ?>
              <p class="error" style="color : red;">* ニックネームを入力してください</p>
            <?php endif; ?>
          </dd>
        <dt>パスワード<span class="required">※必須</span></dt>
          <dd>
          <input type="password" name="password" style="width: 400px; height: 65px;" maxlength="255" value="<?php echo h($form['password']); ?>" placeholder="パスワードを入力してください"/>
          <?php if(isset($form['password']) && $error['password'] === 'blank'): ?>
            <p class='error' style="color : red;">* パスワードを入力してください</p>
          <?php endif; ?>
          <?php if(isset($form['password']) && $error['password'] === 'length'):?>
            <p class="error" style="color : red;">* パスワードは4文字以上で入力してください</p>
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