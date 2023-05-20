<?php

    include('../connect/conn.php'); 

    //---------------------------------------------------

        $data = file_get_contents("php://input");
        // echo "這是php接收到的資料" .$data;

        // 接收到的資料轉成json檔
        $data_arr = json_decode($data, true);
        $tickOrderId = $data['tickOrderId'];

        //建立SQL
        $sql = "DELETE FROM monsterdb.TICK_ORDER WHERE TICK_ORDER_ID = :tick_order_id";
        $stmt = $pdo->query($sql);
        $stmt->bindParam(':tick_order_id', $tickOrderId);

?>