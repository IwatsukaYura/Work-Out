<?php
  session_start();
  require('function_library.php');

  //確認画面から書き直すを選択したとき、値を保持するようにする
  if(isset($_GET['action']) && $_GET['action'] === 'rewrite' && isset($_SESSION['form'])){
    $form = $_SESSION['form'];
} else{
  //書き直しではないときは、$formのそれぞれの値を空に設定
    $form = [
        'name' => '',
        'password' => '',
        'question' => '',
    ];
}


  $error=[];
  //フォーム内容のチェック
  if($_SERVER['REQUEST_METHOD'] === 'POST'){// POSTでフォームから送信されたとき
    $form['name'] = filter_input(INPUT_POST,'name', FILTER_SANITIZE_STRING);
    if($form['name'] === ''){
      $error['name'] = 'blank';
    }else{
      $db = dbconnect();  //DB接続
      $stmt = $db->prepare('select count(*) from members where name=?');

      if(!$stmt){
        die($db->error);
      }
      //フォームで送られてきたnameがDB上に何個あるか数えるSQL文を実行
      $stmt->bind_param('s', $form['name']);
      $success = $stmt->execute();

      if(!$success){
        die($db->error);
      }
      //SQL文の結果を$cntに代入
      $stmt->bind_result($cnt);
      $stmt->fetch();

      //もし、DB上に同じ名前があったら、エラーを返す。
      if($cnt > 0){
        $error['name'] = 'same';
      }

    }

    $form['password'] = filter_input(INPUT_POST,'password', FILTER_SANITIZE_STRING);
    if($form['password'] === ''){//パスワードが入力されていないとき
      $error['password'] = 'blank';
    }
    else if(strlen($form['password']) < 4){//パスワードの長さが4未満の時
      $error['password'] = 'length';
    }

    //フォームのすべてにエラーが存在しないとき
    if(empty($error)){
      $_SESSION['form'] = $form;

      header('Location: signin_check.php');
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
  <title>Signin</title>
</head>
<body>
  <header>
    <?php include("header.html") ?>
  </header>
  <main>
    <a href="./login.php"><p class="create_account">ログイン画面へ</p></a>
    <h2 class="sign-in">サインイン</h2>
    <form action="" method="post">
    <dl>
        <dt>ニックネーム<span class="required">※必須</span></dt>
          <dd>
            <input class = "user_info" type="text" name="name"  maxlength="255"  placeholder="名前を入力してください" value="<?php echo h($form['name']); ?>"/>
            <?php if(isset($error['name']) && $error['name'] === 'blank'): ?>
              <p class="error" style="color : red;">* ニックネームを入力してください</p>
            <?php endif; ?>
            <?php if(isset($error['name']) && $error['name'] === 'same'): ?>
              <p>そのニックネームは既に使用されています</p>
            <?php endif; ?>
          </dd>
        <dt>パスワード<span class="required">※必須</span></dt>
          <dd>
          <input class = "user_info" type="password" name="password" maxlength="255" value="<?php echo h($form['password']); ?>" placeholder="4文字以上のパスワードを入力してください"/>
          <?php if(isset($form['password']) && $error['password'] === 'blank'): ?>
            <p class='error' style="color : red;">* パスワードを入力してください</p>
          <?php endif; ?>
          <?php if(isset($form['password']) && $error['password'] === 'length'):?>
            <p class="error" style="color : red;">* パスワードは4文字以上で入力してください</p>
          <?php endif; ?>
          </dd>
      </dl>
      <div>
        <input type="submit" value="ユーザ作成" class="create_user">
      </div>
    </form>
  </main>
</body>
</html>