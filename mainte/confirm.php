<?php
session_start();

require './db_connetction.php';

// htmlspecialcharsで入力でのXSS防止
function h($str) {
  return htmlspecialchars($str,ENT_QUOTES);
}

// データベースに入力ができない
if(!empty($_POST)) {
  $stmt = $pdo->prepare('INSERT INTO users SET name = ? , email = ? , password = ? , gender = ? , age = ?');
  $stmt =bindValue(1 , $_SESSION['join']['your_name']);
  $stmt =bindValue(2 , $_SESSION['join']['email']);
  $stmt =bindValue(3 , sha1($_SESSION['join']['password']));
  $stmt =bindValue(4 , $_SESSION['join']['gender']);
  $stmt =bindValue(5 , $_SESSION['join']['age']);
  $stmt = execute();
}

var_dump($_SESSION['join']);
if(!isset($_SESSION['join'])) {
  header('Location:register.php');
  exit();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<body>
<form action="./thanks.php" method="post">
  <label for="name">お名前:<?php echo h($_SESSION['join']['your_name']) ?><br>
  </label><br><br>
  <label for="email">メールアドレス:<?php echo h($_SESSION['join']['email']) ?><br>
  </label><br><br>
  <label for="password">パスワード:表示されません<br>
  </label><br><br>
  <label for="url">ホームページ:<?php echo h($_SESSION['join']['url']) ?>
  </label><br><br>
  <label for="gender">性別:<?php echo h($_SESSION['join']['gender']) ?><br>
  </label><br><br>
  <label for="age">年齢<?php echo h($_SESSION['join']['age']) ?><br>
  </label><br><br>
  <p>この情報でお間違い無いですか？</p>
  <input type="submit" value="間違い無いので送信する" name="submited">
</form>
</body>
</html>