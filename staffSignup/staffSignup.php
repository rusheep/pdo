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


    echo $account =htmlspecialchars( $_POST["Account"]);
    echo $pwd = htmlspecialchars( $_POST["PWD"]);
    echo $permissions = htmlspecialchars($_POST["permissions"]);

    // $account = htmlspecialchars($account);
    // $pwd = htmlspecialchars($pwd);

    $sql = "INSERT INTO member(Account, PWD, permissions, CreateDate) VALUES (:account, :pwd, :permissions, NOW())";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':account', $account);
    $stmt->bindParam(':pwd', $pwd);
    $stmt->bindParam(':permissions', $permissions);
    $stmt->execute();



    if($stmt->rowCount() > 0){
        header("Location: Select.php");
    }else{
            echo "新增失敗!";
    }

?>