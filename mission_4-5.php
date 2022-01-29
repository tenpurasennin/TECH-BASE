<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_4-5</title>
</head>
<body>
   <?php
   // DB接続設定
    $dsn = 'データベース名';
    $user = 'ユーザ名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    //INSERT データを入力
    $sql = $pdo -> prepare("INSERT INTO tbtest (name, comment) VALUES (:name, :comment)"); 
    //データのセット
    //bindParam("プレースホルダー名",セットするデータ,データの型)
    //プレースホルダーに値をセットするための関数
    $sql -> bindParam(':name', $name, PDO::PARAM_STR);
    $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
    $name = 'AB';
    $comment = '新規'; //好きな名前、好きな言葉は自分で決めること
    //SQL実行
    $sql -> execute();
   ?>
</body>
</html>