<?php
        include('../../Lib/conn.php');

       //---------------------------------------------------

       //建立SQL語法
       $sql = "SELECT * FROM BACKSTAGE_MEMBER";

       //執行並查詢，會回傳查詢結果的物件，必須使用fetch、fetchAll...等方式取得資料
        $statement = $pdo->query($sql);

        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        $json_results = json_encode($data);

        echo $json_results;
?>