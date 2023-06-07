<?php
include('../../Lib/conn.php');

session_start();

if (isset($_SESSION['MemberAccount'])) {
    $phoneOrEmail = $_SESSION['MemberAccount']; // 從會話中獲取電話號碼或電子郵件地址
    $sql = "SELECT * FROM MEMBER WHERE PHONE = :phoneOrEmail OR EMAIL = :phoneOrEmail";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':phoneOrEmail', $phoneOrEmail);
    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);
} else {
    echo "帳號未定義";
}
?>