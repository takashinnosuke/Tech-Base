<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-1</title>
</head>
<body>
    <form action="" method="post">
        <input type = "text" name = "name" value = "名前">
        <input type = "text" name = "str" value = "コメント">
        <input type = "submit" name = "submit">
    </form>
    <?php
        //プログラム起動時に，書き込まれるのを防ぐため，
        //名前，内容が空でない場合に，書き込む
        if ($_POST["str"] != "" && $_POST["name"] != ""){
            $str = $_POST["str"];
            $name = $_POST["name"];
            $time = date("Y/m/d H:i:s");
            $filename = "mission_3.txt";
            
            //テキストファイルがない場合，投稿番号を１にし，
            //テキストファイルがある場合，ファイル内の要素数+1の投稿番号を設定する
            if (file_exists($filename)){
                $lines = file($filename, FILE_IGNORE_NEW_LINES);
                $num = count($lines) + 1;
            }
            else{
                $num = 1;
            }
            
            $com = $num . "<>" . $name . "<>" . $str . "<>" . $time;
            
            $fp = fopen($filename, "a");
            
            fwrite($fp, $com.PHP_EOL);
            fclose($fp); 
        }
        
    ?>
</body>
</html>