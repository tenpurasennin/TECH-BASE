<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-2</title>
</head>
<body>
    <form action = "" method = "post">
        <input type = "text" name = "name"　value = "名前" placeholder = "名前"> <br>
        <input type = "text" name = "str"　value = "コメント" placeholder = "コメント"> <br>
        <input type = "submit" name = "submit">
    </form>
    <?php
    if(isset($_POST["name"]) && ! empty($_POST["name"])){
        if(isset($_POST["str"]) && ! empty($_POST["str"])){
            
            $name = $_POST["name"]; //名前
            $str = $_POST["str"]; //コメント
            $filename = "mission_3-2.txt"; //テキストファイル名
            $date = date("Y/m/d H:i:s"); //投稿日時
            //投稿番号
            if(file_exists($filename)){
                $datas = file($filename,FILE_IGNORE_NEW_LINES);
                $count= count($datas) + 1; //count関数：配列を入れると、配列の要素数を返す
            }else{
                $count = 1; //ファイルが無い場合、投稿番号は１
            }
            
            $con = $count. "<>". $name ."<>". $str. "<>". $date; //各変数を結合
            //テキストファイルに記録
            $fp = fopen($filename,"a");
            fwrite($fp,$con.PHP_EOL);
            fclose($fp);
            
            if(file_exists($filename)){
                $datas = file($filename,FILE_IGNORE_NEW_LINES);
                
                foreach($datas as $data){
                    //explode("区切り文字","文字列データ");
                    //文字列データを区切り文字で分解し、配列で格納
                    $words = explode("<>",$data);
                    foreach($words as $word){
                        echo $word." ";
                    }
                    echo "<br>";
                }
            }
            
        }
    }else{
        echo "名前、コメントを入力して送信してください";
    }
    ?>
</body>
</html>