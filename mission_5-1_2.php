<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>投稿フォーム</title>
</head>
<body>
    <form action = "" method = "post">
        <input type = "text" name = "name"　value = "名前" placeholder = "名前"> <br>
        <input type = "text" name = "comment"　value = "コメント" placeholder = "コメント"> <br>
        <input type = "text" name = "input_pass" placeholder = "パスワード"> <br>
        <input type = "submit" name = "send"> <br>
   <?php
   // DB接続設定
    $dsn = 'データベース名';
    $user = 'ユーザ名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    //ーーーーーーーーーーー投稿フォームーーーーーーーーーーーーーーーーーーーー
    if(isset($_POST["send"])){ //送信ボタンを押したか
       if(!empty($_POST["name"])){ //名前があるか
           if(!empty($_POST["comment"])){ //コメントがあるか
                if(!empty($_POST["input_pass"])){ //パスワードがあるか
                 //データの受け取り
                 $name = $_POST["name"]; //名前
                 $comment = $_POST["comment"]; //コメント
                 $date = date("Y/m/d H:i:s"); //投稿日時
                 $pass = $_POST["input_pass"]; //パスワード
                 //テーブルが無いとき、テーブルを作成
                 $sql = "CREATE TABLE IF NOT  EXISTS exam"
                 ." ("
                 . "id INT AUTO_INCREMENT PRIMARY KEY," //投稿番号
                 . "name char(128)," //名前
                 . "comment TEXT," //コメント
                 . "date char(32)," //日付
                 . "pass char(32)" //パスワード
                 .");";
                 $stmt = $pdo -> query($sql); 
                 
                 //INSERT データを入力
                 $sql = $pdo -> prepare("INSERT INTO exam (name, comment,date,pass) VALUES (:name, :comment, :date, :pass)"); 
                 $sql -> bindParam(':name', $name, PDO::PARAM_STR);
                 $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
                 $sql -> bindParam(':date', $date, PDO::PARAM_STR);
                 $sql -> bindParam(':pass', $pass, PDO::PARAM_STR);
                 $sql -> execute();
                }else echo "パスワードを入力してください<br>";
            }else echo "コメントを入力してください<br>";
        }else echo "名前を入力してください<br>";
    }
    
    //--------------------------掲示板の表示-----------------------------------
    //SHOW　テーブルの存在を確認
    $sql = "SHOW TABLES";
    $result = $pdo -> query($sql);
    foreach($result as $row){
        //SELECT データの表示
        if($row[0] == "exam"){
            $sql = 'SELECT * FROM exam';
            $stmt = $pdo->query($sql);
            $results2 = $stmt->fetchAll(); //fetchAll()データを配列で取得
            foreach ($results2 as $row){
                //$rowの中にはテーブルのカラム名が入る
                echo "【". $row['id'].'】';
                echo $row['name'].' :  ';
                echo $row['comment'].'  ';
                echo $row['date'].',  ';
                echo $row['pass'].'<br>';
                echo "<hr>";
            }
        }
    }
    
   
   ?>
</body>
</html>