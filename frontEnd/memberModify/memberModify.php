<?php
include('../../Lib/conn.php');

session_start();

if (isset($_SESSION['MemberAccount'])) {
    $phoneNum = $_SESSION['MemberAccount']; // 從會話中獲取電話號碼
    $sql = "SELECT * FROM MEMBER WHERE PHONE = :phoneNum";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':phoneNum', $phoneNum);
    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);
} else {
    echo "帳號未定義";
}
?>