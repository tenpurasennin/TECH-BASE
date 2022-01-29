<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-3</title>
</head>
<body>
    <form action = "" method = "post">
        <input type = "text" name = "str"　value = "コメント" placeholder = "コメント"> <br>
        <input type = "submit" name = "submit">
    </form>
    <?php
    if(isset($_POST["str"]) && ! empty($_POST["str"])){
        $str = $_POST["str"];
        $filename = "mission_2-3.txt";
        $fp = fopen($filename,"a");
        fwrite($fp,$str.PHP_EOL);
        fclose($fp);
        
        if(file_exists($filename)){
            $comments = file($filename, FILE_IGNORE_NEW_LINES);
            foreach($comments as $comment){
                echo $comment."<br>";
            }
        }
    }else{
        echo "フォームにコメントを入力して送信してください";
    }
    ?>
</body>
</html>