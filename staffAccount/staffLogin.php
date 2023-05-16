<?php

        session_start();

        // if(isset( $_SESSION["account"])){

        // }else {
        //     請先登入
        // }

        include('../connect/conn.php');

        //--------------------------------------------------
        
        
        $data = file_get_contents("php://input");
        // echo "這是php接收到的資料" .$data;
        $data_arr = json_decode($data, true);

        $account = $data_arr['account'];
        $pwd = $data_arr['pwd'];
        // echo $account;


        //建立SQL語法
        $sql = "SELECT ACCOUNT,PURVIEW_LEVEL_ID FROM BACKSTAGE_MEMBER WHERE ACCOUNT = :account AND PASSWORD = :pwd";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":account" , $account); 
        $stmt->bindParam(":pwd" , $pwd); 
        $stmt->execute();

       //檢查結果
       $num = $stmt->rowCount(); // 函式返回結果集中行的數量

        if($num > 0){
            //登入成功，設定SESSION變數
                // echo 1;
                $_SESSION["status"] = true;
                $_SESSION["account"] = $account;

                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $status = array("status" => "true");
                $message =  array("message" => "登入成功");
                $result = array_merge($result, $status,$message);



                $json_results = json_encode($result);
                echo $json_results;
                // echo $_SESSION["login"];

        } else {
            //登入失敗，顯示錯誤訊息
            
            $status = array("status" => "false");
            $message =  array("message" => "登入失敗");
            $result = array_merge($status,$message);


            $json_results = json_encode($result);
            echo $json_results;
        }

?>