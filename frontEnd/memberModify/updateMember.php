<?php
include('../../Lib/conn.php');

session_start();

$data = file_get_contents("php://input");
$data_arr = json_decode($data, true);

$phone = $_SESSION['MemberAccount']; // 電話號碼作為條件

$email = $data_arr['emailAdd'];
$name = $data_arr['name'];
$birthday = $data_arr['birthDate'];
$address = $data_arr['address'];

$sql = "UPDATE MEMBER
        SET NAME = :name, BIRTHDAY = :birthDate,
            EMAIL = :emailAdd, ADDRESS = :address
        WHERE PHONE = :phoneNum";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':birthDate', $birthday);
$stmt->bindParam(':emailAdd', $email);
$stmt->bindParam(':address', $address);
$stmt->bindParam(':phoneNum', $phone);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    echo "更新成功!";
} else {
    echo "更新失敗!";
}
?>