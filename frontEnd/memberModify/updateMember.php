<?php
include('../../Lib/conn.php');

$data = file_get_contents("php://input");
$data_arr = json_decode($data, true);

$name = $data_arr['name'];
$birthday = $data_arr['birthDate'];
$phone = $data_arr['phoneNum'];
$email = $data_arr['emailAdd'];
$address = $data_arr['address'];

echo $name;
echo $birthday;
echo $email;
echo $address;

$sql = "UPDATE MEMBER
        SET NAME = :name, BIRTHDAY = :birthday, PHONE = :phone,
            EMAIL = :email, ADDRESS = :address
        WHERE MEMBER_ID = :member_Id";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':birthday', $birthday);
$stmt->bindParam(':phone', $phone);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':address', $address);
$stmt->bindParam(':member_Id', $memberId);
$stmt->execute();

 // 回傳是否成功
if ($stmt->rowCount() > 0) {
  $status = array("status" => "true");
  $json_results = json_encode($status);
  echo $json_results;
} else {
  $status = array("status" => "false");
  $json_results = json_encode($status);
  echo $json_results;
}
?>