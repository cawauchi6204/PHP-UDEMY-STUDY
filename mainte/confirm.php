<?php

session_start();

require './db_connection.php';

if(!isset($_SESSION['join'])) {
  header('Location:register.php');
  exit();
}

// htmlspecialcharsで入力でのXSS防止
function h($str) {
  return htmlspecialchars($str,ENT_QUOTES);
}


// データベースに入力ができない
if(!empty($_POST)) {
  $stmt = $pdo->prepare("INSERT INTO users SET name = :name , email = :email , password = :password , gender = :gender , age = :age");

  $name = $_SESSION['join']['your_name'];
  $email=$_SESSION['join']['email'];
  // sha1でパスワードの暗号化
  $password=sha1($_SESSION['join']['password']);
  $gender=$_SESSION['join']['gender'];
  $age=$_SESSION['join']['age'];
  // メソッドだったのに$stmt=bindParamとしていたので直した
  // だがいまだデータベースに入力できず
  // try文の中にpreparedstatmentを書いたらDBに直接登録できたのでおそらくbindParamあたりが作動していない
  $stmt->bindValue(':name' , $name);
  $stmt->bindValue(':email' , $email);
  $stmt->bindValue(':password' , $password);
  $stmt->bindValue(':gender' , $gender);
  $stmt->bindValue(':age' , $age);
  $stmt->execute();

  unset($_SESSION['join']);

  header('Location:thanks.php');
  exit();
}

var_dump($_SESSION['join']['your_name']);
var_dump($_SESSION['join']['email']);
var_dump($_SESSION['join']['password']);
var_dump($_SESSION['join']['gender']);
var_dump($_SESSION['join']['age']);


?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<body>
<form action="" method="post">
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
  <!-- このhiddenを付け足してからDB連携することができた -->
  <input type="hidden" name="action" value="submit">
  <input type="submit" value="登録する">
</form>
</body>
</html>