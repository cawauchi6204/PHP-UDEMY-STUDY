<?php

// フォームのバリデーション
if($_POST['your_name'] ==='') {
  $error['your_name'] = 'blank';
}

if($_POST['email'] ==='') {
  $error['your_email'] = 'blank';
}

if($_POST['your_name'] ==='') {
  $error['your_name'] = 'blank';
}

// 最初ここcount()で判定してたけどcountは配列の要素の数にしか使えないのだった
if(strlen($_POST['password']) < 4 ) {
  $error['password'] = 'lnegth';
}

if($_POST['password'] != $_POST['password2']) {
  $error['password'] = 'wrong';
}

if(isset($_POST['check'])) {
  $error['check'] = 'empty';
}

if(empty($error)) {
  header('Location:confirm.php');
  exit();
}

?>
!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <body style="text-align: center; width: 300px;">
    <form action="./register.php" method="post">
      <label for="name"
        >お名前<br />
        <?php if($_POST['your_name'] === 'blank'):  ?>
        <?php echo '空白です'; ?>
        <?php endif; ?>
        <input type="text" name="your_name" id="name" /> </label
      ><br /><br />
      <label for="email"
        >メールアドレス<br />
        <?php if($_POST['email'] === 'blank'):  ?>
        <?php echo '空白です'; ?>
        <?php endif; ?>
        <input type="email" name="email" /> </label
      ><br /><br />
      <label for="password"
        >パスワード<br />
        <?php if($_POST['password'] === 'blank'):  ?>
        <?php echo '空白です'; ?>
        <?php endif; ?>
        <?php if($_POST['password'] === 'length'):  ?>
        <?php echo '長さがたりません'; ?>
        <?php endif; ?>
        <?php if($_POST['password'] === 'wrong'):  ?>
        <?php echo '確認用のパスワードと違います'; ?>
        <?php endif; ?>
        <input type="password" name="password" id="password" /> </label
      ><br /><br />
      <label for="password2"
        >パスワード再入力<br />
        <input type="password" name="password2" id="password2" /> </label
      ><br /><br />
      <label for="url"
        >ホームページ<br />
        <input type="text" name="url" /> </label
      ><br /><br />
      <label for="gender"
        >性別<br />
        <input type="radio" name="gender" value="man" id="gender" />男性
        <input type="radio" name="gender" value="woman" id="gender" />女性 </label
      ><br /><br />
      <label for="age"
        >年齢<br />
        <input
          type="number"
          name="age"
          id="age"
          placeholder="選択してください"
        /> </label
      ><br /><br />
      <label for="check"> <input type="checkbox" name="check" /> </label
      >注意事項に同意する<br /><br />
      <?php if($_POST['check'] === 'empty'):  ?>
      <?php echo 'チェックがされていません'; ?>
      <?php endif; ?>
      <input type="submit" value="送信する" name="submited" />
    </form>
  </body>
</html>
