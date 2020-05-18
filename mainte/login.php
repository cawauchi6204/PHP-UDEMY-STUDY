<?php
ini_set( 'display_errors', 1 );
ini_set( 'error_reporting', E_ALL );
//ログインができない
session_start();

require './db_connection.php';

if(isset($_SESSION['id'])) {
  header('Location:main.php');
  exit();
}


if (isset($_POST['email']) && isset($_POST['password'])) {
  $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email AND password = :password');
  $email=$_POST['email'];
  // sha1でパスワードの暗号化
  $password=sha1($_POST['password']);
  $stmt->bindValue(':email', $email);
  $stmt->bindValue(':password', $password);
  // クエリの実行
  $stmt->execute();
  $row = $stmt->fetch();
  var_dump($row);
  
  // fetchで値をとってきてあればmain.phpなければregister.phpへ遷移させる
  if ($row) {
    var_dump($row);
    $_SESSION['id'] = $row['id'];
    header('Location:main.php');
    exit();
  } else {
    $error['login'] = 'failed';
  }

}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン画面</title>
</head>
<body>
  <h1>ログインする</h1>
  <p>メールアドレスとパスワードを記入してログインしてください。<br>入会手続きがまだの方はこちらからどうぞ</p>
  <a href="./register.php">入会手続きをする</a>
  <form action="" method="post">
    <label for="">メールアドレス
      <input type="email" name="email" id="">
    </label>
    <br><br>
    <label for="">パスワード
      <input type="password" name="password" id="">
    </label>
    <br><br>
    <input type="hidden" name="action">
    <input type="submit" name="login" value="サインインする">
  </form>
</body>
</html>