<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-3</title>
</head>
<body>
    <form action="" method="post">
        <input type = "text" name = "name" placeholder = "名前">
        <input type = "text" name = "str" placeholder = "コメント">
        <input type = "submit" name = "submit">
        <input type = "text" name = "delete_str" placeholder = "削除番号指定用フォーム">
        <input type = "submit" name = "delete_submit" value = "削除">
    </form>
    <?php
        $str = $_POST["str"];
        $name = $_POST["name"];
        $delete_str = $_POST["delete_str"];
        $time = date("Y/m/d H:i:s");
        $filename = "mission_3.txt";
        $fp = fopen($filename, "a");
        
        //投稿番号の設定
        if (file_exists($filename)){
            $lines = file($filename, FILE_IGNORE_NEW_LINES);
            $dev_str = explode("<>", end($lines));
            $num = $dev_str[0] + 1;
        }
        else{
            $num = 1;
        }
        
        //書き込む文字列を変数に代入する
        $com = $num . "<>" . $name . "<>" . $str . "<>" . $time;
        
        
        //名前，内容が空でないかつ，削除対象番号が入力されていない場合
        if($_POST["delete_str"] == "" && $_POST["str"] != "" && $_POST["name"] != ""){
        
            //ファイルに書き込む
            fwrite($fp, $com.PHP_EOL);
            fclose($fp);
        
        }
        

        //削除対象番号が入力されている場合
        if ($delete_str != ""){
            
            if (file_exists($filename)){
                
                //ファイルを1行ずつ読み込み，配列変数に代入する
                $lines = file($filename, FILE_IGNORE_NEW_LINES);
                ftruncate($fp, 0);
                
                //ファイルを読み込んだ配列を，配列の数だけループさせる
                foreach ($lines as $line){
                    
                    //区切り文字「<>」で分割して，それぞれの値を取得
                    $dev_str = explode("<>", $line);
                    //投稿番号を取得して，削除対象番号と比較
                    if ($dev_str[0] != $delete_str){
                    //等しくない場合は，追加書き込みを行う
                        fwrite($fp, $line.PHP_EOL);

                    }
                    else{
                    //等しい場合は，何も書き込まない
                    }
                }
                fclose($fp);
            }
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