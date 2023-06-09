<?php
include('../../Lib/conn.php');
include('../../Lib/MemberCheck.php');

getMemberAccount();

$memberId= $_SESSION["MemberId"];
// echo $memberId;

$data = file_get_contents("php://input");
$data_arr = json_decode($data, true);
// print_r($data_arr);

$phone = $data_arr['phoneNum'];
$email = $data_arr['emailAdd'];
$name = $data_arr['name'];
$birthday = $data_arr['birthDate'];
$address = $data_arr['address'];

$sql = "UPDATE MEMBER
        SET NAME = :name, BIRTHDAY = :birthDate,
            EMAIL = :emailAdd, ADDRESS = :address,PHONE = :phoneNum
        WHERE MEMBER_ID = :memberId";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':birthDate', $birthday);
$stmt->bindParam(':emailAdd', $email);
$stmt->bindParam(':address', $address);
$stmt->bindParam(':phoneNum', $phone);
$stmt->bindParam(':memberId', $memberId);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    echo "更新成功!";
} else {
    echo "更新失敗!";
}
?>
