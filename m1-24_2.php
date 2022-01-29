<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-24_2</title>
</head>
<body>
    <?php
    $str = "かきくけこ";
    file_put_contents("mission_1-24.txt", $str ."\n", FILE_APPEND);
    echo "書き込み成功!<br>";
    ?>
</body>
</html>