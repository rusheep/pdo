<?php
include('../../Lib/conn.php');

session_start();

$data = file_get_contents("php://input");
$data_arr = json_decode($data, true);

$id = $_SESSION['MemberAccount'];
$email = $data_arr['emailAdd'];
$name = $data_arr['name'];
$birthday = $data_arr['birthDate'];
$phone = $data_arr['phoneNum'];
$address = $data_arr['address'];

$sql = "UPDATE MEMBER
        SET NAME = :name, BIRTHDAY = :birthDate, PHONE = :phoneNum,
            EMAIL = :emailAdd, ADDRESS = :address
        WHERE ACCOUNT = :id";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':birthDate', $birthday);
$stmt->bindParam(':phoneNum', $phone);
$stmt->bindParam(':emailAdd', $email);
$stmt->bindParam(':address', $address);
$stmt->bindParam(':id', $id);
$stmt->execute();

if ($stmt->execute()) {
    echo "更新成功!";
} else {
    echo "更新失败!";
}

// 現在 $id 變量與綁定參數 :id 保持一致，應該能夠解決該錯誤。
//請確保在使用 $_SESSION['MemberAccount'] 之前，會話中已經設置了 MemberAccount 鍵，並且包含有效的值。
?>
