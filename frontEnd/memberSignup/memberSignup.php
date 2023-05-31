<?php

include('../../Lib/conn.php');

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

$sql = "INSERT INTO MEMBER (NAME,GENDER,BIRTHDAY,PHONE,EMAIL,PASSWORD) VALUES (:name, :gender, :birthday, :phone, :email, :pwd)";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':gender', $gender);
$stmt->bindParam(':birthday', $birthday);
$stmt->bindParam(':phone', $phone);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':pwd', $pwd);
// 執行SQL
$affectedRow=$stmt->execute();

if($affectedRow>0){
    echo '註冊成功';
}else{
    echo '註冊失敗';
}
