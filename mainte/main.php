<?php
ini_set( 'display_errors', 1 );
ini_set( 'error_reporting', E_ALL );
session_start();
require './db_connection.php';

function h($str) {
  return htmlspecialchars($str,ENT_QUOTES);
}

// データベースにメッセージを登録
if(isset($_POST['message'])) {
  $messages = $pdo->prepare('INSERT INTO posts SET message = :message');
  $messages->bindValue(':message' , $_POST['message']);
  $messages->execute();
  header('Location:main.php');
}

// データベースのIDとセッションIDを照らし合わせる
if(isset($_SESSION['id'])) {
  $members = $pdo->prepare('SELECT * FROM users WHERE id = :id');
  $members->bindValue(':id' , $_SESSION['id']);
  $members->execute();
  $member = $members->fetch();
}else {
  header('Location:login.php');
  exit();
}

$posts = $pdo->prepare('SELECT message FROM posts');
$posts->execute();
$post =$posts->fetchAll();
$messages = $post;
print_r($post);
// var_dump($_POST['message']);
// var_dump($messages);
// var_dump($member);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>メモ</h1>
  <p>メッセージをどうぞ<?php echo h($member['name'])  ?>さん</p>
  <form action="" method="post">
    <textarea name="message" id="" cols="60" rows="20"></textarea><br>
    <input type="hidden" name="action">
    <input type="submit" value="投稿する">
  </form>
  <ol>
    <?php foreach($messages as $message): ?>
      <li><?php echo h($message['message']) ?><hr></li>
    <?php endforeach; ?>
  </ol>
  <br><br>
  <a href="./logout.php">ログアウトする</a>
</body>
</html>