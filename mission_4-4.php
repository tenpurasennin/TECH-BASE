<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_4-4</title>
</head>
<body>
   <?php
   // DB接続設定
    $dsn = 'データベース名';
    $user = 'ユーザ名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    //SHOW CREATE TABLE　作成したテーブルの構成を確認
    $sql ='SHOW CREATE TABLE tbtest';
    $result = $pdo -> query($sql);
    var_dump($result);
    foreach ($result as $row){
        echo $row[1]."<br>";
    }
    echo "<hr>";
   ?>
</body>
</html>