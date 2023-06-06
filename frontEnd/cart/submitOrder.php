<?php

include('../../Lib/conn.php');
include('../../Lib/MemberCheck.php');
//---------------------------------------------------
//
$data = file_get_contents("php://input");

getMemberName();
$memberId = $_SESSION["MemberId"];
// echo $memberId;

$getOrder = "SELECT ORDER_ID FROM `ORDER` WHERE MEMBER_ID = :memberId AND ORDER_STATE = '購物車'";
$stmt = $pdo->prepare($getOrder);
$stmt->bindParam(':memberId', $memberId);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $orderId = $row['ORDER_ID'];
    // 可以在這裡進行需要的操作，例如印出 ORDER_ID 或其他處理
    // 這個迴圈僅考慮一筆結果，如有多筆結果，可能需要適當修改
    // echo $orderId;
}

$updateCart = "UPDATE `ORDER` SET ORDER_STATE='已完成' WHERE ORDER_ID = :order_id";
$stmt = $pdo->prepare($updateCart);
$stmt->bindParam(':order_id', $orderId);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    // 更新成功
    echo "訂單送出成功";
} else {
    // 更新失敗
    echo "訂單送出失敗";
}