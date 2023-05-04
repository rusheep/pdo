<?php

        session_start();

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

        $data = file_get_contents("php://input");
        // echo "這是php接收到的資料" .$data;
        $data_arr = json_decode($data, true);

        //建立SQL語法
        $sql = "SELECT * FROM member";
        $stmt = $pdo->query($sql);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //將結果轉換為JSON格式，並存儲到localstorage
        $json_results = json_encode($results);
        echo "<script>localStorage.setItem('member_data', '$json_results');</script>";
        echo $json_results;
        // header("Location: manager.html"); 

?>