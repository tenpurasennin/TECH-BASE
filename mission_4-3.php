<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_4-3</title>
</head>
<body>
   <?php
   // DB接続設定
    $dsn = 'データベース名';
    $user = 'ユーザ名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    //SHOW TABLES データベースにあるテーブルを確認
    $sql = "SHOW TABLES";
    $result = $pdo -> query($sql);
    foreach($result as $row){
        echo $row[0]."<br>";
    }
    echo "<hr>";
    
   ?>
</body>
</html>