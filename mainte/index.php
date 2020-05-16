<?php 

require './db_connetction.php';

// $sql = 'select * from contacts where id=2';
// $stmt = $pdo->query($sql);
// $result = $stmt->fetchall(); //sqoの項目を撮ってくる

// echo '<pre>';
// print_r($result);
// echo '</pre>';

$sql = 'select * from contacts where id=:id';//プレースホルダー
$stmt = $pdo->prepare($sql);
$stmt->bindValue('id' , 2 , PDO::PARAM_INT); //紐つけ
$stmt->execute(); //実行
//ユーザー入力ありの場合だと1段階多くなる

$result = $stmt->fetchall();

echo '<pre>';
print_r($result);
echo '</pre>';

$pdo->beginTransaction();

try{

  $stmt = $pdo->prepare($sql);
  $stmt->bindValue('id' , 2 , PDO::PARAM_INT); //紐つけ
  $stmt->execute(); //実行

  $pdo->commit();

}catch(PDOException $e) {
  $pdo->rollback();
}
