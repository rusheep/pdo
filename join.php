<?php

    //MySQL相關資訊
    $db_host = "127.0.0.1";
    $db_user = "root";
    $db_pass = "yo0960797";
    $db_select = "pdo";

    //建立資料庫連線物件
    $dsn = "mysql:host=".$db_host.";dbname=".$db_select.";charset=utf8";

    //建立PDO物件，並放入指定的相關資料
    $pdo = new PDO($dsn, $db_user, $db_pass);

    //---------------------------------------------------

    //建立SQL


    echo $account = $_POST["Account"];
    echo $pwd = $_POST["PWD"];
    echo $Permissions = $_POST["Permissions"];

    $sql = "INSERT INTO member(Account, PWD, Permissions , CreateDate) VALUES (:account, :pwd, :Permissions, NOW())";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':account', $account);
    $stmt->bindParam(':pwd', $pwd);
    $stmt->bindParam(':Permissions', $Permissions);
    $stmt->execute();



    if($stmt->rowCount() > 0){
        header("Location: Select.php");
    }else{
            echo "新增失敗!";
    }

?>