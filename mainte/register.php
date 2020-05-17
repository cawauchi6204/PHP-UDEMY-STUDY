<?php

// ここでセッションに記録しないとページが遷移した時にPOSTの情報が保持されない
session_start();

if (!empty($_POST)) {

// フォームのバリデーション
  if ($_POST['your_name'] =='') {
      $error['your_name'] = 'blank';
  }

  if ($_POST['email'] =='') {
      $error['your_email'] = 'blank';
  }

  if ($_POST['your_name'] =='') {
      $error['your_name'] = 'blank';
  }

  // 最初ここcount()で判定してたけどcountは配列の要素の数にしか使えないのだった
  if (strlen($_POST['password']) < 4) {
      $error['password'] = 'lnegth';
  }

  if ($_POST['password'] != $_POST['password2']) {
      $error['password'] = 'wrong';
  }

  if (!isset($_POST['check'])) {
      $error['check'] = 'empty';
  }

  if (empty($error)) {
      // $_POSTの情報を$_SESSION['join']の中に格納している
      // 次のページで使うには$_SESSION['join']['hogeehoge']で利用できる
      $_SESSION['join'] = $_POST;
      header('Location:confirm.php');
      exit();
  }
}

print_r($error);

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <body>
    <form action="./register.php" method="post">
      <label for="name"
        >お名前<br />
        <?php if($error['your_name'] === 'blank'):  ?>
        <p>空白です</p>
        <?php endif; ?>
        <input type="text" name="your_name" id="name" /> </label
      ><br /><br />
      <label for="email"
        >メールアドレス<br />
        <?php if($error['email'] === 'blank'):  ?>
        <p>空白です</p>
        <?php endif; ?>
        <input type="email" name="email" autocomplete="off"/> </label
      ><br /><br />
      <label for="password"
        >パスワード<br />
        <?php if($error['password'] === 'blank'):  ?>
        <p>空白です</p>
        <?php endif; ?>
        <?php if($error['password'] === 'length'):  ?>
        <p>長さがたりません</p>
        <?php endif; ?>
        <?php if($error['password'] === 'wrong'):  ?>
        <p>確認用のパスワードと違います</p>
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
        <input type="radio" name="gender" value="man"  />男性
        <input type="radio" name="gender" value="woman"  />女性 </label
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
      <?php if($error['check'] === 'empty'):  ?>
      <p>チェックがされていません</p>
      <?php endif; ?>
      <input type="submit" value="送信する" name="submited" />
    </form>
  </body>
</html>
