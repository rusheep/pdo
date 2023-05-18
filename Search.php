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
    $account_search = '%' . $_POST["Account"] . '%';
    $sql = "SELECT * FROM member WHERE Account LIKE :account_search";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':account_search', $account_search);

    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $json_results = json_encode($data);
    echo $json_results;

?>