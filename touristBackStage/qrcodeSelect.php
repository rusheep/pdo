<?php
        include('../Lib/conn.php');

       //---------------------------------------------------

       //建立SQL語法
       $sql = "SELECT * 
        FROM monsterdb.RIDES_QRCODE MRO
        JOIN monsterdb.QRCODE_ORDER MQO ON MRO.RIDES_QRCODE_ID = MQO.RIDES_QRCODE_ID
        JOIN monsterdb.MEMBER MM ON MQO.QRCODE_ORDER_ID = MM.MEMBER_ID";

    
        $statement = $pdo->query($sql);

        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        $json_results = json_encode($data);

        echo $json_results;
?>