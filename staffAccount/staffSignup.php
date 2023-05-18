<?php

    include('../connect/conn.php'); 

    //---------------------------------------------------

    $data = file_get_contents("php://input");
    // echo "這是php接收到的資料" .$data;
    $data_arr = json_decode($data, true);

    $account = $data_arr['account'];
    $pwd = $data_arr['pwd'];
    $permissions = $data_arr['permissions'];

    //建立SQL


    // SELECT *
    // FROM monsterdb.TICK MT
    // JOIN monsterdb.TICK_ORDER MTO ON MTO.TICK_ID = MT.TICK_ID
    // JOIN monsterdb.MEMBER MM ON MM.MEMBER_ID = MTO.TICK_ORDER_ID;
    

    $sql = "INSERT INTO BACKSTAGE_MEMBER (ACCOUNT, PASSWORD, PURVIEW_LEVEL_ID) VALUES (:account, :pwd, :permissions)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':account', $account);
    $stmt->bindParam(':pwd', $pwd);
    $stmt->bindParam(':permissions', $permissions);
    $stmt->execute();



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