<?php
session_start();

require './db_connection.php';



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <p>こんにちは<?php echo $_POST['your_name'] ?>さん</p>
  <a href="./logout.php">ログアウトする</a>
</body>
</html>