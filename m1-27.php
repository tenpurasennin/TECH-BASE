<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-27</title>
</head>
<body>
    <form action = "" method = "post">
        <input type = "text" name = "num" placeholder = "数字を入力して下さい"> <br>
        <input type = "submit" name = "submit">
    </form>
    <?php
    if(isset($_POST["num"])){
        $num = $_POST["num"]; 
        $filename="mission_1-27.txt";
        $fp = fopen($filename,"a");
        fwrite($fp, $num.PHP_EOL);
        fclose($fp);
        echo "書き込み成功!<br>";
        
        if(file_exists($filename)){
            $lines = file($filename, FILE_IGNORE_NEW_LINES);
            foreach($lines as $line){
                if($line%15 == 0){
                    echo "FizzBuzz<br>";
                    }elseif($line%3 == 0){
                        echo "Fizz<br>";
                        }elseif($line%5 == 0){
                            echo "Buzz<br>";
                            }else{
                                echo $line."<br>";
                            }
            }
        }
    }else{
        echo "送信されたものがありません";
    }
    ?>
    
</body>
</html>