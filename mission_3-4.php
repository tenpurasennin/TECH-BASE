<?php //valueに値を入れなければいけないので、HTML文より先に編集部分のコードを書く。
$filename = "mission_3-4.txt";
if(isset($_POST["submit3"])){ //編集ボタン押しているか
        if(isset($_POST["edit"]) && ! empty($_POST["edit"])){ //編集番号が入力されてるか
            $edit = $_POST["edit"];
        if(file_exists($filename)){ //テキストが存在するか
            $datas = file($filename,FILE_IGNORE_NEW_LINES); //一行ずつ取得
            $count = count($datas); //行数
            for($i=0;$i<$count;$i++){ //一行ずつループ
                $flag = 0; //フラグを０にする（投稿番号取得のため）
                $words = explode("<>",$datas[$i]); //区切り文字で一行を分解
                foreach($words as $word){ //1項目ずつループ
                    if($word == $edit){ //編集番号を見つける
                        $flag = 1; //フラグ立てる
                        $name_e = $words[1]; //名前（inputのvalueに代入）
                        $comment_e = $words[2]; //コメント
                        break; //12：foreachループから抜ける
                    }
                }
                if($flag == 1){ //編集番号を見つけたら
                    break; //9：for文ループから抜ける
                }
            }
        }
        }else{
            echo "編集番号を入力してください。<br>";
        }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-4</title>
</head>
<body>
    <form action = "" method = "post">
        【投稿フォーム】<br>
        <input type = "text" name = "name" value="<?php if(isset($name_e))echo $name_e; ?>" placeholder = "名前"> <br>
        <input type = "text" name = "str" value = "<?php if(isset($comment_e))echo $comment_e; ?>" placeholder = "コメント"> <br>
        <input type = "hidden" name = "edit_num" value = "<?php if(isset($edit))echo $edit; ?>">
        <input type = "submit" name = "submit"> <br>
        【削除フォーム】<br>
        <input type = "text" name = "del" placeholder = "削除対象番号"> <br>
        <input type = "submit" name = "submit2" value = "削除"> <br>
        【編集フォーム】<br>
        <input type = "text" name = "edit" placeholder = "編集対象番号"> <br>
        <input type = "submit" name = "submit3" value = "編集">
    </form>
    <?php
    $filename = "mission_3-4.txt"; //テキストファイル名
    if(isset($_POST["submit"])){ //送信ボタン押
    if(isset($_POST["name"]) && ! empty($_POST["name"])){ //名前入力済
        if(isset($_POST["str"]) && ! empty($_POST["str"])){ //コメント入力済
        if(isset($_POST["edit_num"]) && ! empty($_POST["edit_num"])){ //編集番号がある（編集機能）
        
        $edit_num = $_POST["edit_num"]; //編集番号
        $name = $_POST["name"]; //名前
        $str = $_POST["str"]; //コメント
        $date = date("Y/m/d H:i:s"); //投稿日時
        $con = $edit_num. "<>". $name ."<>". $str. "<>". $date; //各変数を結合
        
        if(file_exists($filename)){ //テキストが存在するか
            $datas = file($filename,FILE_IGNORE_NEW_LINES); //一行ずつ取得
            $fp = fopen($filename,"w"); //テキストに書くためにファイルオープン
            $count = count($datas); //行数
            for($i=0;$i<$count;$i++){
                $flag = 0; //フラグを0にする
                $words = explode("<>",$datas[$i]);
                foreach($words as $word){
                    if($word == $edit_num){ //編集番号だったら
                        $flag = 1; //フラグを立てる
                        echo $edit_num. " ". $name ." ". $str. " ". $date; //編集した文をブラウザに表示
                        break; //foreach文のループ抜ける
                    }
                    echo $word." "; //ブラウザに表示（区切り文字なし）
                }
                
                if($flag == 0){ //フラグが0なら
                fwrite($fp,$datas[$i].PHP_EOL); //既存の一文をテキストに入力
                echo "<br>";
                }else if($flag == 1){
                    fwrite($fp,$con.PHP_EOL); //編集で変更した文をテキストに出力
                    echo "<br>";
                }
            }
            fclose($fp);
        }
        
        }else{ //送信機能
            
            $name = $_POST["name"]; //名前
            $str = $_POST["str"]; //コメント
            $date = date("Y/m/d H:i:s"); //投稿日時
            //投稿番号
            if(file_exists($filename)){
                $datas = file($filename,FILE_IGNORE_NEW_LINES);
                $last = count($datas) - 1; //count関数：配列を入れると、配列の要素数を返す。配列は0から始まるので、－１
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
        }else{
            echo "コメントを入力してください。<br>";
        }
    }else{
        echo "名前を入力してください";
    }
    }else if(isset($_POST["submit2"])){ //削除機能
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
        }else{
            echo "削除番号を入力してください。<br>";
        }
    }
    
    ?>
</body>
</html>