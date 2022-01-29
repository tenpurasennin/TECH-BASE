<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_4-9</title>
</head>
<body>
   <?php
   // DB接続設定
    $dsn = 'データベース名';
    $user = 'ユーザ名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    //DROP テーブルの削除
    $sql = 'DROP TABLE exam';
    $stmt = $pdo->query($sql);
   ?>
</body>
</html>