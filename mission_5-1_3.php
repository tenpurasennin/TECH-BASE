<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>削除フォーム</title>
</head>
<body>
    <form action = "" method = "post">
        【投稿フォーム】<br>
        <input type = "text" name = "name"　value = "名前" placeholder = "名前"> <br>
        <input type = "text" name = "comment"　value = "コメント" placeholder = "コメント"> <br>
        <input type = "text" name = "input_pass" placeholder = "パスワード"> <br>
        <input type = "submit" name = "SEND"> <br>
        【削除フォーム】<br>
        <input type = "text" name = "del_num" placeholder = "削除対象番号"> <br>
        <input type="text" name="del_pass" placeholder = "パスワード"> <br>
        <input type = "submit" name = "DEL" value = "削除"> <br>
   <?php
   // DB接続設定
    $dsn = 'データベース名';
    $user = 'ユーザ名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    //ーーーーーーーーーーー投稿フォームーーーーーーーーーーーーーーーーーーーー
    if(isset($_POST["SEND"])){ //送信ボタンを押したか
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
                 
                }else echo "パスワードを入力してください<br><hr>";
            }else echo "コメントを入力してください<br><hr>";
        }else echo "名前を入力してください<br><hr>";
    }
    
    //－－－－－－－－－－－－－－－削除フォームーーーーーーーーーーーーーーー   
    if(isset($_POST["DEL"])){ //削除ボタン押してるか
        if(!empty($_POST["del_num"])){ //番号があるか
            if(!empty($_POST["del_pass"])){ //パスワードがあるか
                
                //データの受け取り
                $del_num = $_POST["del_num"];
                $del_pass = $_POST["del_pass"];
                
                //－－－－－－－－－パスワードチェックーーーーーーーー
                $sql = 'SELECT * FROM exam where id=:id'; //削除番号の行だけ選択
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $del_num, PDO::PARAM_INT); //削除番号をセット
                $stmt->execute();
                $results = $stmt->fetchAll();
                
                foreach ($results as $row){
                    if($row["pass"] == $del_pass){ //パスワードチェック
                        //DELETE　削除
                        $sql = 'delete from exam where id=:id';
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':id', $del_num, PDO::PARAM_INT);
                        $stmt->execute();
                    }else echo "パスワードが間違っています<br><hr>";
                }
                
            }else echo "パスワードを入力してください<br><hr>";
        }else echo "削除対象番号を入力してください<br><hr>";
    }
    
    //--------------------------掲示板をブラウザに表示-----------------------------------
    //SHOW　テーブルの存在を確認
    $sql = "SHOW TABLES";
    $result = $pdo -> query($sql);
    foreach($result as $row){
        //SELECT データの表示
        if($row[0] == "exam"){
            $sql = 'SELECT * FROM exam';
            $stmt = $pdo->query($sql);
            $results2 = $stmt->fetchAll();
            foreach ($results2 as $row){
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