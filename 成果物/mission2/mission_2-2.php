<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-2</title>
</head>
<body>
    <form action="" method="post">
        <input type = "text" name = "str" value = "コメント">
        <input type = "submit" name = "submit">
    </form>
    <?php
        $str = $_POST["str"];
        //フォームが空でない場合に，動くようにする
        if  ($str != ""){
            echo $str . "を受け付けました<br>";
        }
        else{
            echo "";
        }
        
        $filename = "mission_2-2.txt";
        //入力データのファイル書き込み
        $fp = fopen($filename, "w");
        fwrite($fp, $str.PHP_EOL);
        fclose($fp);
        if (file_exists($filename)){
            $lines = file($filename, FILE_IGNORE_NEW_LINES);
            
            foreach($lines as $line){
                /*if ($line == ""){
                    echo "";
                }*/
                //特定の文字に応じて，特別なメッセージを返す
                if($line == "完成！"){
                    echo "おめでとう！<br>";
                }
                else{
                    echo $line . "<br>";
                }
                
            }
        }
    ?>
</body>
</html>