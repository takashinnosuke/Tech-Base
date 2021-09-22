<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-18</title>
</head>
<body>
    <?php
        $favorite_term = "tech-base";
        for ($i = 0;$i < 100; $i++){
            echo $i + 1 . "：" . $favorite_term;
            echo "<br>";
        }
    ?>
</body>
</html>