<?php
// if(!isset($_SESSION['join'])) {
//   header('Location:register.php');
//   exit();
// }
session_start();

require './db_connetction.php';

// htmlspecialcharsで入力でのXSS防止
function h($str) {
  return htmlspecialchars($str,ENT_QUOTES);
}

$name = $_SESSION['join']['your_name'];
$email=$_SESSION['join']['email'];
$password=$_SESSION['join']['password'];
$gender=$_SESSION['join']['gender'];
$age=$_SESSION['join']['age'];

// データベースに入力ができない
if(!empty($_POST)) {
  $stmt = $pdo->prepare("INSERT INTO users SET name = :name , email = :email , password = :password , gender = :gender , age = :age");
  // メソッドだったのに$stmt=bindParamとしていたので直した
  // だがいまだデータベースに入力できず
  // try文の中にpreparedstatmentを書いたらDBに直接登録できたのでおそらくbindParamあたりが作動していない
  $stmt->bindParam(1 , $name);
  $stmt->bindParam(2 ,  $email);
  $stmt->bindParam(3 , $password);
  $stmt->bindParam(4 , $gender);
  $stmt->bindParam(5 , $age);
  $stmt->execute();
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