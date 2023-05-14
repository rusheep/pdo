<?php
        include('../connect/conn.php');

       //---------------------------------------------------

       //建立SQL語法
       $sql = "SELECT * 
       FROM MONSTER.RIDES_QRCODE MRO
       JOIN MONSTER.QRCODE_ORDER MQO ON MRO.RIDES_QRCODE_ID = MQO.RIDES_QRCODE_ID
       JOIN MONSTER.MEMBER MM ON MQO.QRCODE_ORDER_ID = MM.MEMBER_ID";

       //執行並查詢，會回傳查詢結果的物件，必須使用fetch、fetchAll...等方式取得資料
        $statement = $pdo->query($sql);

        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        $json_results = json_encode($data);

        echo $json_results;
?>