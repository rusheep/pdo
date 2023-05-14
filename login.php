<?php

       session_start();

       //MySQL相關資訊
       $db_host = "127.0.0.1";
       $db_user = "root";
       $db_pass = "yo0960797";
       $db_select = "pdo";

       //建立資料庫連線物件
       $dsn = "mysql:host=".$db_host.";dbname=".$db_select.";charset=utf8";

       //建立PDO物件，並放入指定的相關資料
       $pdo = new PDO($dsn, $db_user, $db_pass);

       //--------------------------------------------------
       
       
       $data = file_get_contents("php://input");
       // echo "這是php接收到的資料" .$data;
       $data_arr = json_decode($data, true);

       $account = $data_arr['account'];
       $pwd = $data_arr['pwd'];
       // echo $account;


       //建立SQL語法
       $sql = "SELECT Account,permissions FROM member WHERE Account = :account AND PWD = :pwd";
       $stmt = $pdo->prepare($sql);
       $stmt->bindParam(":account" , $account); 
       $stmt->bindParam(":pwd" , $pwd); 
       $stmt->execute();

       //檢查結果
       $num = $stmt->rowCount(); // 函式返回結果集中行的數量

       if($num > 0){
         //登入成功，設定SESSION變數
              // echo 1;
              $_SESSION["login"] = true;
              $_SESSION["account"] = $account;

              $result = $stmt->fetch(PDO::FETCH_ASSOC);
              $status = array("status" => "true");
              $message =  array("message" => "登入成功");
              $result = array_merge($result, $status,$message);



              $json_results = json_encode($result);

              echo $json_results;

       } else {
         //登入失敗，顯示錯誤訊息
              
              $status = array("status" => "false");
              $message =  array("message" => "登入失敗");
              $result = array_merge($status,$message);

              $json_results = json_encode($result);
              echo $json_results;
       }

?>