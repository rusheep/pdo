<?php

    
    include('../Lib/conn.php');
    //---------------------------------------------------

    $data = file_get_contents("php://input");
    // echo "這是php接收到的資料" .$data;

    // 接收到的資料轉成json檔
    $data_arr = json_decode($data, true);

    // foreach跑json檔案中的每一筆資料
    foreach ($data_arr['ticketBooking']['ticketBooking'] as $booking) {

        // 定義變數接資料
        $ticketType = $booking['ticketType'];
        $ticketDate = $booking['ticketDate'];
        $ticketAmmount = $booking['ticketAmmount'];
        $fastPassFacility = $booking['fastPassFacility'];
        $userid = $data_arr['ticketBooking']['username'];

        // 快速通關在物件裡面的陣列 所以要再跑一次foreach
        $fast_pass1 = null;
        $fast_pass2 = null;
        $fast_pass3 = null;
        $fast_pass4 = null;
        $fast_pass5 = null;
        $fast_pass6 = null;
        
        foreach ($fastPassFacility as $index => $value) {
            ${"fast_pass" . ($index + 1)} = $value;
        }
            echo $userid;
            echo $ticketType; // 输出：adult
            echo $ticketDate; // 输出：日期
            echo $ticketAmmount; // 输出：數量
            // print_r( $fastPassFacility);
            echo $fast_pass1; //輸出:是否購買快速通關
            echo $fast_pass2;
            echo $fast_pass3;
            echo $fast_pass4;
            echo $fast_pass5;
            echo $fast_pass6;


        //建立SQL


        $sql = "INSERT INTO monsterdb.TICK_ORDER (MEMBER_ID, TICK_ID, TICK_NUM,TICK_DATE,FAST_PASS1,FAST_PASS2,FAST_PASS3,FAST_PASS4,FAST_PASS5,FAST_PASS6)
            VALUES  (:member_id,:tick_id,:tick_num,now(),:fast_pass1,:fast_pass2,:fast_pass3,:fast_pass4,:fast_pass5,:fast_pass6)";


        $stmt = $pdo->prepare($sql);

        // 防注入
        $stmt->bindParam(':member_id', $userid);
        $stmt->bindParam(':tick_id', $ticketType);
        $stmt->bindParam(':tick_num', $ticketAmmount);
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


    }

?>