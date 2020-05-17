<?php

require_once './db_connetction.php';

function h($str) {
  return htmlspecialchars($str,ENT_NOQUOTES);
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
  <label for="name">お名前:<br>

  </label><br><br>
  <label for="email">メールアドレス<br>
  </label><br><br>
  <label for="password">パスワード<br>
  </label><br><br>
  <label for="password2">パスワード再入力<br>
  </label><br><br>
  <label for="url">ホームページ<br>
  </label><br><br>
  <label for="gender">性別<br>
  </label><br><br>
  <label for="age">年齢<br>
  </label><br><br>
  <label for="contents">お問い合わせ内容<br><br>
    <textarea name="contents" id="contents" cols="30" rows="10"></textarea>
  </label><br><br>
  <input type="submit" value="送信する" name="submited">
</form>
</body>
</html>