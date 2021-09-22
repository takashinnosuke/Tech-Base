<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_5-1</title>
</head>
<body>
    
    
    <?php
    
        //データベースの接続
        $dsn = 'データベース名';
        $user = 'ユーザー名';
        $password = 'パスワード';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        
        //テーブルを作成する
        $sql = "CREATE TABLE IF NOT EXISTS tb"
            ." ("
            . "id INT AUTO_INCREMENT PRIMARY KEY,"
            . "name char(32),"
            . "comment TEXT,"
            . "time TIMESTAMP,"
            . "passwords char(32)"
            .");";
        $stmt = $pdo->query($sql);
    
    
        //field
        if (isset($_POST["name"])){
            $names = $_POST["name"];
        }else{
            $names = "";
        }
        if (isset($_POST["str"])){
            $strs = $_POST["str"];
        }else{
            $strs = "";
        }
        if (isset($_POST["delete_str"])){
            $delete_strs = $_POST["delete_str"];
        }else{
            $delete_strs = "";
        }
        if (isset($_POST["edit_str"])){
            $edit_str = $_POST["edit_str"];
        }else{
            $edit_str = "";
        }
        if (isset($_POST["password1"])){
            $password1 = $_POST["password1"];
        }else{
            $password1 = "";
        }


        //編集対象番号が入力されている場合
        if ($edit_str != ""){
            $sql = 'SELECT * FROM tb';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
                //投稿番号を取得して，編集対象番号と比較
                if ($row['id'] == $edit_str){
                    //等しい場合は，その投稿の「名前」と「コメント」を取得
                    if ($_POST["password3"] == $row['passwords']){
                        $edit_name = $row['name'];//名前
                        $edit_str2 =  $row['comment'];//コメント
                        $edit_num = $row['id'];//投稿番号
                    }
                    else{
                        echo "error :パスワードが違います<br>";
                    }
                }
            }
        }
        
        //新規書き込み処理
        if($names != "" && $strs != ""){
            //新しいテキストボックス内が空かどうか確認する
            if ($_POST["edit_num"] != ""){
            //空でない場合
                $id = $_POST["edit_num"]; //変更する投稿番号
                $name = $names;
                $comment = $strs;
                $time = date("Y/m/d H:i:s");
                $passwords = $password1;
                $sql = 'UPDATE tb SET name=:name,comment=:comment,time=:time,passwords=:passwords WHERE id=:id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->bindParam(':time', $time, PDO::PARAM_STR);
                $stmt->bindParam(':passwords', $passwords, PDO::PARAM_STR);
                $stmt->execute();
                echo $id . "番目の投稿を編集しました";
            }
            
            else{
            //空の場合
                $sql = $pdo -> prepare("INSERT INTO tb (name, comment, time, passwords) VALUES (:name, :comment, :time, :passwords)");
                $sql -> bindParam(':name', $name, PDO::PARAM_STR);
                $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
                $sql -> bindParam(':time', $time, PDO::PARAM_STR);
                $sql -> bindParam(':passwords', $passwords, PDO::PARAM_STR);
                //フォームに入力した値を代入する   
                $name = $names;
                $comment = $strs;
                $time = date("Y/m/d H:i:s");
                $passwords = $password1;
                $sql -> execute();
                echo "新規投稿を受け付けました";
            }
        }
        
        //削除対象番号が入力されている場合
        if($delete_strs != ""){
            $sql = 'SELECT * FROM tb';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
                //投稿番号を取得して，削除対象番号と比較
                if ($row['id'] == $delete_strs){
                    //等しい場合は，その投稿を削除する
                    if ($_POST["password2"] == $row['passwords']){
                        $id = $delete_strs;
                        $sql = 'delete from tb where id=:id';
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                        $stmt->execute();
                        echo "投稿を削除しました<br>";
                    }
                    else{
                        echo "error :正しいパスワードを入力してください<br>";
                    }
                }
            }
        }
    ?>
    
    <div style="background-color: cornflowerblue;">
        <h1><span style="color:mintcream">Web掲示板</span></h1>
    </div>
    <form action="" method="post">
        <input type = "text" name = "name" placeholder = "名前"
        value = "<?php if (isset($edit_name)){echo $edit_name;} ?>"><br>
        <input type = "text" name = "str" placeholder = "コメント"
        value = "<?php if (isset($edit_name)){echo $edit_str2;} ?>"><br>
        <input type = "password" name = "password1" placeholder = "パスワード">
        <input type = "hidden" name = "edit_num" placeholder = "指定投稿番号"
        value = "<?php if (isset($edit_num)){echo $edit_num;} ?>">
        <input type = "submit" name = "submit"><br><br>
        <input type = "text" name = "delete_str" placeholder = "削除番号"><br>
        <input type = "password" name = "password2" placeholder = "パスワード">
        <input type = "submit" name = "delete_submit" value = "削除"><br><br>
        <input type = "text" name = "edit_str" placeholder = "編集番号"><br>
        <input type = "password" name = "password3" placeholder = "パスワード">
        <input type = "submit" name = "edit_submit" value = "編集"><br><br>
        </form>
      
    <?php    
    
       //データベースの内容をブラウザ上に表示させる処理
       $sql = 'SELECT * FROM tb';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        //パスワード要素を削除する
        unset($results['passwords']);
        foreach ($results as $row){
            //$rowの中にはテーブルのカラム名が入る
            echo $row['id'].' ';
            echo $row['name'].' ';
            echo $row['comment'].' ';
            echo $row['time'].'<br>';
            echo '<hr>';
        }
        
    ?>
    
</body>
</html>