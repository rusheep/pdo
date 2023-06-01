<?php
include('../../Lib/conn.php');

session_start();
$id = $_SESSION['MemberAccount']; // 從中獲取會員ID
// print_r($_SESSION);
$sql = "SELECT * FROM MEMBER WHERE ACCOUNT = :member_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':member_id', $id);
$stmt->execute();

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);
?>