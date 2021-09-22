<?php 

$dsn = 'データベース名';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

//！この SQLは tb テーブルを削除します！】
$sql = 'DROP TABLE tb';
$stmt = $pdo->query($sql);

?>