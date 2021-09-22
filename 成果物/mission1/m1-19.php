<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-19</title>
</head>
<body>
    <?php
        for ($sum = 0; $sum < 100; $sum++){
            if ($sum % 3 == 0 && $sum % 5 == 0){
            echo "Fizzbuzz<br>";
            }
            elseif ($sum % 3 == 0){
                echo "Fizz<br>";
            }
            elseif($sum % 5 == 0){
                echo "Buzz<br>";
            }
            else{
                echo $sum;
                echo "<br>";
            }
        }
        
    ?>
</body>
</html>