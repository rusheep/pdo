<?php

    include('../Lib/conn.php');

    //---------------------------------------------------

    $data = file_get_contents("php://input");
    // echo "這是php接收到的資料" .$data;
    $data_arr = json_decode($data, true);

    $name = $data_arr['name'];
    $gender = $data_arr['gender'];
    $birthday = $data_arr['birthday'];
    $phone = $data_arr['phone'];
    $email = $data_arr['email'];
    $pwd = $data_arr['pwd'];

    //建立SQL

    $sql = "INSERT INTO MEMBER (NAME,GENDER,BIRTHDAY,PHONE,EMAIL,PASSWORD) VALUES (:name, :gender, :birthday, :phone, :email, :password)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':birthday', $birthday);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    if($stmt->rowCount() > 0){
        $status = array("status" => "true");
        $json_results = json_encode($status);
        echo $json_results;
    }else{
        $status = array("status" => "false");
        $json_results = json_encode($status);
        echo $json_results;
    }
