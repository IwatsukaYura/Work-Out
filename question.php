<?php
require('function_library.php');
session_start();

if(isset($_SESSION['id']) && $_SESSION['name']){
  $id = $_SESSION['id'];
  $name = $_SESSION['name'];
}else{
  header('Location: index.php');
}

$form = ['question' => ''];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $form['question'] = filter_input(INPUT_POST,'question', FILTER_SANITIZE_STRING);
  if($form['question'] === ''){
    $error['question'] = 'blank';
  }else{
    $error['question'] = 'thanks';
    $db = dbconnect();
    $stmt = $db->prepare('insert into questions (user_name,question) value (?,?)');
    if(!$stmt){
      die($db->error);
    }
    $stmt->bind_param('ss', $name,$form['question']);
    $success = $stmt->execute();

    if(!$success){
      die($db->error);
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
  <div class="QA_contents">
    <div class="QA">
      <details class="qa-007">
        <summary>このアプリでなにができるの？</summary>
        <p>筋トレ初心者に向けて部位別にランダムでトレーニングメニューを自動的に組んでくれます。<br>何から始めたらいいかわからない方は、このアプリで決められたメニューから始めてみましょう。</p>
      </details>
      <details class="qa-007">
          <summary>各種目の重量や回数、セット数はどれくらいやればいいの？</summary>
          <p>7～10回で限界が来る重さで3セットから始めてみましょう。</p>
      </details>
      <details class="qa-007">
          <summary>セット間の休憩はどれくらいとればいいですか？</summary>
          <p>2~3分くらいを目安にしましょう。</p>
      </details>
      <details class="qa-007">
          <summary>トレーニングをするタイミングはいつがベスト?</summary>
          <p>空腹状態では行かないようにしましょう！  ご飯を食べてから60~90分後に開始するとベストです。</p>
      </details>
      <details class="qa-007">
          <summary>週何回トレーニングすればいいの？</summary>
          <p>初心者の方は週3回くらいから始めてみましょう！</p>
      </details>
      <details class="qa-007">
          <summary>筋肉痛がある状態でその部位の筋トレはしていいのですか？</summary>
          <p>筋肉痛があるときはその部位のトレーニングは避けましょう。筋肉痛というのは筋繊維が壊れている状態ですので、筋肉痛が治るまではそれ以上イジメないであげてください</p>
      </details>
      <details class="qa-007">
          <summary>瘦せたいんですけど、有酸素運動はしなくていいんですか？</summary>
          <p>基本的には有酸素運動をしなくても痩せます。筋トレをして、食事を見直すことを推奨します。</p>
      </details>
      <details class="qa-007">
          <summary>どんな食事をすれば痩せますか？</summary>
          <p>ここでは解答しきれませんので個別にご連絡ください。その人に合った食事メニューをご提案いたします。</p>
      </details>
    </div>
    <div class="what">
      <form action="" method="POST">
        <p>ほかに疑問点があれば気軽に送信してください。</p>
        <textarea name="question" cols="30" rows="10"></textarea><br>
        <?php if($error['question'] === 'blank'): ?>
          <p class="error" style="color : red;">※質問を入力してから送信してください</p>
        <?php endif;?>
        <?php if($error['question'] === 'thanks'): ?>
          <p class="error" style="color : red;">ご意見ありがとうございます。</p>
        <?php endif;?>
        <input type="submit" value="送信する">
      </form>
    </div>
  </div>
</body>
</html>