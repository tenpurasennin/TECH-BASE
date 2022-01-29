<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-2</title>
</head>
<body>
    <form action = "" method = "post">
        <input type = "text" name = "str"　value = "コメント" placeholder = "コメント"> <br>
        <input type = "submit" name = "submit">
    </form>
    <?php
    if(isset($_POST["str"]) && ! empty($_POST["str"])){
        $str = $_POST["str"];
        $filename = "mission_2-2.txt";
        $fp = fopen($filename,"w");
        fwrite($fp,$str.PHP_EOL);
        fclose($fp);
        
        if(file_exists($filename)){
            $comment = file($filename, FILE_IGNORE_NEW_LINES);
            echo $comment[0];
            echo " (送信内容)を受け付けました！<br>";
            //フォームに「あいうえお」が入力されているか判断
            if($comment[0] == "あいうえお"){
                echo "おめでとうございます！";
            }
        }
    }else{
        echo "フォームにコメントを入力して送信してください";
    }
    ?>
</body>
</html>