<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ex_3-3</title>
</head>
<body>
    <form action = "" method = "post">
        <input type = "text" name = "name"　value = "名前" placeholder = "名前"> <br>
        <input type = "text" name = "str"　value = "コメント" placeholder = "コメント"> <br>
        <input type = "submit" name = "submit"> <br>
        <input type = "text" name = "del" placeholder = "削除対象番号"> <br>
        <input type = "submit" name = "submit2" value = "削除">
    </form>
    <?php
    if(isset($_POST["submit"])){
        echo $_POST["name"];
        echo $_POST["str"]."<br>";
    }else if(isset($_POST["submit2"])){
        echo $_POST["del"];
    }
    ?>
</body>
</html>