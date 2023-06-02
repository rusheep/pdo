<?php

    include('../../Lib/conn.php');

    //---------------------------------------------------

        $data = file_get_contents("php://input");
        // echo "這是php接收到的資料" .$data;

        $tickOrderId = $data;
        //建立SQL
        $sql = "DELETE FROM TICK_ORDER WHERE TICK_ORDER_ID = :tick_order_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':tick_order_id', $tickOrderId);

        $stmt->execute();


        // 回傳是否成功
        if($stmt->rowCount() > 0){
            $status = array("status" => "true");
            $json_results = json_encode($status);
            echo $json_results;
        }else{
            $status = array("status" => "false");
            $json_results = json_encode($status);
            echo $json_results;
        }

?>