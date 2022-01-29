<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-23</title>
</head>
<body>
    <?php
    $humans = array("Ken","Alice","Judy","BOSS","Bob");
    foreach($humans as $human){
        if($human == "BOSS"){
            echo "Good Morning " . $human . "!<br>";
        }else{
            echo "Hi " . $human . "!<br>";
        }
    }
    ?>
</body>
</html>