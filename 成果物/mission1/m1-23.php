<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-23</title>
</head>
<body>
    <?php
        $members = array("Ken","Alice", "Judy", "BOSS", "Bob");
        foreach($members as $i){
            if ($i == "BOSS"){
                echo "Good moning " . $i . "!" . "<br>";    
            }
            else{
                echo "Hi!" . $i . "<br>";
            }
                
        }
    ?>
</body>
</html>