<?php
        //MySQL相關資訊
        $db_host = "127.0.0.1";
        $db_user = "root";

        //確認自己的密碼
        $db_pass = "yo0960797";
        $db_select = "monsterdb";

        //建立資料庫連線物件
        $dsn = "mysql:host=".$db_host.";dbname=".$db_select.";charset=utf8";

        //建立PDO物件，並放入指定的相關資料
        $pdo = new PDO($dsn, $db_user, $db_pass);

       //---------------------------------------------------
?>