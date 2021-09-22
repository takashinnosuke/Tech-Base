<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-2</title>
</head>
<body>
    <form action="" method="post">
        <input type = "text" name = "name" value = "名前">
        <input type = "text" name = "str" value = "コメント">
        <input type = "submit" name = "submit">
    </form>
    <?php
        
        $str = $_POST["str"];
        $name = $_POST["name"];
        $time = date("Y/m/d H:i:s");
        $filename = "mission_3.txt";
        $fp = fopen($filename, "a");
            
        //テキストファイルがない場合，投稿番号を１にし，
        //テキストファイルがある場合，ファイル内の要素数+1の投稿番号を設定する
        if (file_exists($filename)){
            $num = count(file($filename)) + 1;
        }
        else{
            $num = 1;
        }
        //書き込む文字列を変数に代入する
        $com = $num . "<>" . $name . "<>" . $str . "<>" . $time;
        
        //プログラム起動時に，書き込まれるのを防ぐため，
        //名前，内容が空でない場合に，書き込む
        if ($_POST["str"] != "" && $_POST["name"] != ""){
            //ファイルに書き込む
            fwrite($fp, $com.PHP_EOL);
            fclose($fp);
        }
            
        if (file_exists($filename)){
            //ファイルを1行ずつ読み込み，配列変数に代入する
            $lines = file($filename, FILE_IGNORE_NEW_LINES);
            //ファイルを読み込んだ配列を，配列の数だけループさせる
            foreach ($lines as $line){
                //区切り文字「<>」で分割して，それぞれの値を取得
                $dev_str = explode("<>", $line);
                //上記で取得した値をechoを用いて表示
                $linestr = implode(" ", $dev_str);
                echo $linestr . "<br>";   
            }
        }
    ?>
</body>
</html>