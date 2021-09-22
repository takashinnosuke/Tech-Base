<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-3</title>
</head>
<body>
    <form action="" method="post">
        <input type = "text" name = "str" value = "コメント">
        <input type = "submit" name = "submit">
    </form>
    <?php
        $str = $_POST["str"];
        $filename = "mission_2-3.txt";
        
        //フォームが空でない場合に，動くようにする
        if  ($str != ""){
            echo $str . "を受け付けました<br>";
            
            //入力データのファイル書き込み（追記モード）
            $fp = fopen($filename, "a");
            fwrite($fp, $str.PHP_EOL);
            fclose($fp);
            
            //特定の文字に応じて，特別なメッセージを返す
            if($str == "完成！"){
            echo "おめでとう！<br>";
            }
            else{
                echo $str . "<br>";
            }
        }
        //フォームが空の場合
        else{
            echo "";
        }
    ?>
</body>
</html>