<?php 

$dsn = 'データベース名';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$id = 2;
$sql = 'delete from tbtest where id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$sql = 'SELECT * FROM tbtest';
$stmt = $pdo->query($sql);

$results = $stmt->fetchAll();
foreach ($results as $row){
    //$rowの中にはテーブルのカラム名が入る
    echo $row['id'].',';
    echo $row['name'].',';
    echo $row['comment'].'<br>';
echo "<hr>";
}
?>