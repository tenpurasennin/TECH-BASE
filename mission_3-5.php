<?php //valueに値を入れなければいけないので、HTML文より先に編集部分のコードを書く。
$filename = "mission_3-5.txt";
if(isset($_POST["submit3"])){ //編集ボタン押しているか
        if(isset($_POST["edit"]) && ! empty($_POST["edit"])){ //編集番号が入力されてるか
        if(isset($_POST["edit_pass"]) && ! empty($_POST["edit_pass"])){ //パスワードが入力されてるか
        $edit = $_POST["edit"];
        $edit_pass = $_POST["edit_pass"];
        
        if(file_exists($filename)){
            $datas = file($filename,FILE_IGNORE_NEW_LINES); //一行ずつ取得
            $flag_edit = 0; //フラグを0にする
            foreach($datas as $data){ //一行ずつループ
                $words = explode("<>",$data); //区切り文字で一行を分解
                if($words[0] == $edit){ //編集番号と同じ番号を探す
                    if($words[4] == $edit_pass){ //パスワードが一致しているか
                        $flag_edit = 1;
                        $name_e = $words[1]; //名前（inputのvalueに代入）
                        $comment_e = $words[2]; //コメント
                        $num_e = $edit;
                        break; //foreachループ抜ける
                    }
                }
                if($flag_edit == 1){
                    break;
                }
            }
            if($flag_edit == 0){
                echo "パスワードが間違っています。<br>";
            }
        }
        }else{
            echo "パスワードを入力してください。<br>";
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
    <title>mission_3-5</title>
</head>
<body>
    <form action = "" method = "post">
        <h2>音楽聞くのが好きなので、みんなの好きなアーティストとか曲を書いてほしいです！！ </h2>
        （無かったら趣味とか最近ハマっていること知りたいです！！）<br> <br>
        【投稿フォーム】<br>
        <input type = "text" name = "name" value="<?php if(isset($name_e))echo $name_e; ?>" placeholder = "名前"> <br>
        <input type = "text" name = "str" value = "<?php if(isset($comment_e))echo $comment_e; ?>" placeholder = "コメント"> <br>
        <input type = "hidden" name = "edit_num" value = "<?php if(isset($num_e))echo $num_e; ?>">
        <input type = "text" name = "input_pass" placeholder = "パスワード"> <br>
        <input type = "submit" name = "submit"> <br>
        【削除フォーム】<br>
        <input type = "text" name = "del" placeholder = "削除対象番号"> <br>
        <input type="text" name="del_pass" placeholder = "パスワード"> <br>
        <input type = "submit" name = "submit2" value = "削除"> <br>
        【編集フォーム】<br>
        <input type = "text" name = "edit" placeholder = "編集対象番号"> <br>
        <input type="text" name="edit_pass" placeholder = "パスワード"> <br>
        <input type = "submit" name = "submit3" value = "編集">
    </form>
    <?php
    $filename = "mission_3-5.txt"; //テキストファイル名
    $flag_all = 0;
    if(isset($_POST["submit"])){ //送信ボタン押
    if(isset($_POST["name"]) && ! empty($_POST["name"])){ //名前入力済
        if(isset($_POST["str"]) && ! empty($_POST["str"])){ //コメント入力済
        if(isset($_POST["edit_num"]) && ! empty($_POST["edit_num"])){ //編集番号がある（編集機能）
        if(isset($_POST["input_pass"]) && ! empty($_POST["input_pass"])){ //パスワードがある
        
        $edit_num = $_POST["edit_num"]; //編集番号
        $name = $_POST["name"]; //名前
        $str = $_POST["str"]; //コメント
        $date = date("Y/m/d H:i:s"); //投稿日時
        $input_pass = $_POST["input_pass"]; //パスワード（編集で変更可能）
        $con = $edit_num. "<>". $name ."<>". $str. "<>". $date . "<>". $input_pass. "<>"; //各変数を結合
        
        if(file_exists($filename)){ //テキストが存在するか
            $flag_all = 1;
            $datas = file($filename,FILE_IGNORE_NEW_LINES); //一行ずつ取得
            $fp = fopen($filename,"w"); //テキストに書くためにファイルオープン
            $count = count($datas); //行数
            for($i=0;$i<$count;$i++){
                $flag = 0; //フラグの初期化
                $words = explode("<>",$datas[$i]);
                foreach($words as $word){
                    if($words[0] == $edit_num){ //編集番号だったら
                        $flag = 1; //フラグを立てる
                        echo $edit_num. " ". $name ." ". $str. " ". $date; //編集した文をブラウザに表示
                        break; //foreach文のループ抜ける
                    }
                    if($word != $words[4]){ //パスワードは表示しない
                    echo $word." "; //ブラウザに表示（区切り文字なし）
                    }
                }
                
                if($flag == 0){ //フラグが0なら
                fwrite($fp,$datas[$i].PHP_EOL); //既存の一文をテキストに入力
                }else if($flag == 1){
                    fwrite($fp,$con.PHP_EOL); //編集で変更した文をテキストに出力
                }
                echo "<br>";
            }
            fclose($fp);
        }
        }
        
        }else{ //投稿フォーム
            if(isset($_POST["input_pass"]) && ! empty($_POST["input_pass"])){//パスワードある
            $flag_all = 1;
            $name = $_POST["name"]; //名前
            $str = $_POST["str"]; //コメント
            $date = date("Y/m/d H:i:s"); //投稿日時
            $input_pass = $_POST["input_pass"]; //パスワード
            
            //投稿番号
            if(file_exists($filename)){
                $datas = file($filename,FILE_IGNORE_NEW_LINES);
                $last = count($datas) - 1; //count関数：配列を入れると、配列の要素数を返す。配列は0から始まるので、－１
                $words = explode("<>",$datas[$last]); //データの最後
                $count = $words[0] + 1;//投稿番号はwords[0]に格納されている
            }else{
                $count = 1; //ファイルが無い場合、投稿番号は１
            }
            
            $con = $count. "<>". $name ."<>". $str. "<>". $date . "<>". $input_pass. "<>"; //各変数を結合
            //テキストファイルに記録
            $fp = fopen($filename,"a");
            fwrite($fp,$con.PHP_EOL);
            fclose($fp);
            
            //テキストファイルをブラウザに表示-------------------------------
            if(file_exists($filename)){
                $datas = file($filename,FILE_IGNORE_NEW_LINES);
                
                foreach($datas as $data){
                    //explode("区切り文字","文字列データ");
                    //文字列データを区切り文字で分解し、配列で格納
                    $words = explode("<>",$data);
                    foreach($words as $word){
                        if($word != $words[4]){
                        echo $word." ";
                        }
                    }
                    echo "<br>";
                }
            }
        }else{
            echo "パスワードを入力してください。<br>";
        }
        }
        }else{
            echo "コメントを入力してください。<br>";
        }
    }else{
        echo "名前を入力してください<br>";
    }
    }else if(isset($_POST["submit2"])){ //削除機能
        if(isset($_POST["del"]) && ! empty($_POST["del"])){ //削除番号が書かれているか
        if(isset($_POST["del_pass"]) && ! empty($_POST["del_pass"])){ //パスワードが書かれてるか
         $del_pass = $_POST["del_pass"];
         $del = $_POST["del"];
         if(file_exists($filename)){
            $datas = file($filename,FILE_IGNORE_NEW_LINES);
            $flag_del = 0; //フラグの初期化
            foreach($datas as $data){
                $words = explode("<>",$data);
                $count = count($words); //要素数
                if($words[0] == $del && $words[4] == $del_pass){//パスワードの一致
                   $flag_del = 1;
                   break;
                }
            }
            
            if($flag_del == 1){ 
            $flag_all = 1;
            $fp = fopen($filename,"w");
            foreach($datas as $data){
                $flag = 0; //フラグを0にする
                $words = explode("<>",$data);
                for($i=0;$i<$count;$i++){
                    if($words[0] == $del){ //削除番号だったら
                    $flag = 1;
                    break;
                    }
                    if($words[$i] != $words[4]){
                    echo $words[$i]." "; //ブラウザに表示（区切り文字なし）
                    }
                }
                if($flag == 0){ //フラグが0なら
                fwrite($fp,$data.PHP_EOL);
                echo "<br>";
                }
            }
            fclose($fp);
         }else{
             echo "パスワードが間違っています。<br>";
         }
         }
        }else{
            echo "パスワードを入力してください<br>";
        }
        }else{
            echo "削除番号を入力してください。<br>";
        }
    }
    if($flag_all == 0){//常にブラウザに掲示板を表示する
        if(file_exists($filename)){
            $datas = file($filename,FILE_IGNORE_NEW_LINES);
                
            foreach($datas as $data){
                $words = explode("<>",$data);
                foreach($words as $word){
                    if($word != $words[4]){
                    echo $word." ";
                    }
                }
                echo "<br>";
            }
        }
    }
    ?>
</body>
</html>