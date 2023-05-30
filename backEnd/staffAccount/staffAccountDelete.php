<?php

    include('../../Lib/conn.php');

    //---------------------------------------------------

        $data = file_get_contents("php://input");
        // echo "這是php接收到的資料" .$data;

        // 接收到的資料轉成json檔
        $data_arr = json_decode($data, true);
        // print_r($data_arr);

        $memberId = $data_arr['deleteMemberData']['id'];
        $account = $data_arr['deleteMemberData']['account'];
        $permissions = $data_arr['deleteMemberData']['permissions'];

        // 建立SQL
        $sql = "DELETE FROM BACKSTAGE_MEMBER WHERE BACKSTAGE_MEMBER_ID = :member_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':member_id', $memberId);
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