<?php

    
    include('../../Lib/conn.php');

    //---------------------------------------------------

    $data = file_get_contents("php://input");
    // echo "這是php接收到的資料" .$data;

    $data_arr = json_decode($data, true);
    $refundTicketsData = $data_arr['refundTicketsData'];
    $id = $refundTicketsData['id'];
    $ticketType = $refundTicketsData['ticketType'];
    $refundTicketsAmount = $refundTicketsData['refundTicketsAmount'];
    $ticketDate = $refundTicketsData['ticketDate'];
    $fastPassFacility = $refundTicketsData['fastPassFacility'];


        // 快速通關在物件裡面的陣列 所以要再跑一次foreach
        
        foreach ($fastPassFacility as $index => $value) {
            ${"fast_pass" . ($index + 1)} = $value;
        }
            echo $id;
            echo $ticketType; // 输出：adult
            echo $ticketDate; // 输出：日期
            echo $refundTicketsAmount; // 输出：數量
            // print_r( $fastPassFacility);
            echo $fast_pass1; //輸出:是否購買快速通關
            echo $fast_pass2;
            echo $fast_pass3;
            echo $fast_pass4;
            echo $fast_pass5;
            echo $fast_pass6;


        //建立SQL


        $sql = "UPDATE TICK_ORDER SET TICK_ID = :tick_id, TICK_NUM = :tick_num, TICK_DATE = :tick_date, FAST_PASS1 = :fast_pass1, FAST_PASS2 = :fast_pass2, FAST_PASS3 = :fast_pass3, FAST_PASS4 = :fast_pass4, FAST_PASS5 = :fast_pass5, FAST_PASS6 = :fast_pass6 WHERE TICK_ORDER_ID = :id";



        $stmt = $pdo->prepare($sql);

        // 防注入
        // $stmt->bindParam(':member_id', $userid);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':tick_id', $ticketType);
        $stmt->bindParam(':tick_num',$refundTicketsAmount);
        $stmt->bindParam(':tick_date', $ticketDate);
        $stmt->bindParam(':fast_pass1', $fast_pass1);
        $stmt->bindParam(':fast_pass2', $fast_pass2);
        $stmt->bindParam(':fast_pass3', $fast_pass3);
        $stmt->bindParam(':fast_pass4', $fast_pass4);
        $stmt->bindParam(':fast_pass5', $fast_pass5);
        $stmt->bindParam(':fast_pass6', $fast_pass6);


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