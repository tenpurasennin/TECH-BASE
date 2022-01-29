<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-3</title>
</head>
<body>
    <form action = "" method = "post">
        <input type = "text" name = "name" value = "名前" placeholder = "名前"> <br>
        <input type = "text" name = "str" value = "コメント" placeholder = "コメント"> <br>
        <input type = "submit" name = "submit"> <br>
        <input type = "text" name = "del" placeholder = "削除対象番号"> <br>
        <input type = "submit" name = "submit2" value = "削除">
    </form>
    <?php
    $filename = "mission_3-3.txt"; //テキストファイル名
    if(isset($_POST["submit"])){
    if(isset($_POST["name"]) && ! empty($_POST["name"])){
        if(isset($_POST["str"]) && ! empty($_POST["str"])){
            
            $name = $_POST["name"]; //名前
            $str = $_POST["str"]; //コメント
            $date = date("Y/m/d H:i:s"); //投稿日時
            //投稿番号
            if(file_exists($filename)){
                $datas = file($filename,FILE_IGNORE_NEW_LINES);
                $last = count($datas) - 1; //count関数：配列を入れると、配列の要素数を返す。配列は0から始まるので、－１
                $datas = file($filename,FILE_IGNORE_NEW_LINES);
                $words = explode("<>",$datas[$last]); //データの最後
                $count = $words[0] + 1;//投稿番号はwords[0]に格納されている
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
    }
    }else if(isset($_POST["submit2"])){ //削除ボタンが押されているか
        if(isset($_POST["del"]) && ! empty($_POST["del"])){ //削除番号が書かれているか
         $del = $_POST["del"];
         if(file_exists($filename)){
            $datas = file($filename,FILE_IGNORE_NEW_LINES);
            $fp = fopen($filename,"w");
            $count = count($datas); //行数
            
            for($i=0;$i<$count;$i++){
                $flag = 0; //フラグを0にする
                $words = explode("<>",$datas[$i]);
                foreach($words as $word){
                    if($word == $del){ //削除番号だったら
                        $flag = 1; //フラグを立てる
                        break; //1ループぬける
                    }
                    echo $word." "; //ブラウザに表示（区切り文字なし）
                }
                if($flag == 0){ //フラグが0なら
                fwrite($fp,$datas[$i].PHP_EOL);
                echo "<br>";
                }
            }
            fclose($fp);
         }
        }
    }
    
    ?>
</body>
</html>