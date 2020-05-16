<?php

require_once './db_connetction.php';

function h($str) {
  return htmlspecialchars($str,ENT_NOQUOTES);
}

$email = $_POST['email'];
$url = $_POST['url'];
$gender = $_POST['gender'];
$age = $_POST['age'];
$contents = $_POST['contents'];
$check = $_POST['check'];
$submited = $_POST['submited'];

$errorMessage = "";
$signUpMessage = "";

if (isset($_POST["signUp"])) {
  //ユーザー idのチェック
  if (empty($_POST['your_name'])) {
    $errorMessage = 'ユーザーIDが未入力です';
  } else if (empty($_POST['password'])) {
    $errorMessage = 'パスワードが未入力です';
  } else if (empty($_POST['password2'])) {
    $errorMessage = 'パスワードが未入力です';
  }

  if ( !empty($_POST['your_name']) && !empty($_POST['password'])  && !empty($_POST['password2']) && $_POST['password'] === $_POST['password2'] ){
    // 入力したユーザIDとパスワードを格納
    $name = $_POST['your_name'];
    $password = $_POST['password'];
  }else if ($_POST['password'] != $_POST['password2']) {
    $errorMessage = 'パスワードに誤りがあります';
  }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<body style="text-align:center;width:300px;">
<form action="./confirm.php" method="post">
  <label for="name">お名前<br>
    <input type="text" name="your_name" id="name">
  </label><br><br>
  <label for="email">メールアドレス<br>
    <input type="email" name="email">
  </label><br><br>
  <label for="password">パスワード<br>
    <input type="password" name="password" id="password">
  </label><br><br>
  <label for="password2">パスワード再入力<br>
    <input type="password" name="password2" id="password2">
  </label><br><br>
  <label for="url">ホームページ<br>
    <input type="text" name="url">
  </label><br><br>
  <label for="gender">性別<br>
    <input type="radio" name="gender" value="0" id="gender">男性
    <input type="radio" name="gender" value="1" id="gender">女性
  </label><br><br>
  <label for="age">年齢<br>
    <input type="number" name="age" id="age" placeholder="選択してください">
  </label><br><br>
  <label for="contents">お問い合わせ内容<br><br>
    <textarea name="contents" id="contents" cols="30" rows="10"></textarea>
  </label><br><br>
  <label for="check">
    <input type="checkbox" name="check">
  </label>注意事項に同意する<br><br>
  <input type="submit" value="送信する" name="submited">
</form>
</body>
</html>