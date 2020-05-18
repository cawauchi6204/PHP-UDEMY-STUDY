<?php
session_start();
require './db_connection.php';

function h($str) {
  return htmlspecialchars($str,ENT_QUOTES);
}

if(isset($_SESSION['id'])) {
  $members = $pdo->prepare('SELECT * FROM users WHERE id = :id');
  $members->bindValue(':id' , $_SESSION['id']);
  $members->execute();
  $member = $members->fetch();
}else {
  header('Location:login.php');
  exit();
}

var_dump($_POST['message']);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>ひとこと掲示板</h1>
  <p>メッセージをどうぞ<?php echo h($member)  ?>さん</p>
  <form action="" method="post">
    <textarea name="message" id="" cols="60" rows="20"></textarea><br>
    <input type="hidden" name="action">
    <input type="submit" value="投稿する">
  </form>
  <br><br>
  <a href="./logout.php">ログアウトする</a>
</body>
</html>