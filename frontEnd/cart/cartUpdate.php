<?php

include('../../Lib/conn.php');

//---------------------------------------------------
//
$data = file_get_contents("php://input");
// echo "這是php接收到的資料" . $data;

$data_arr = json_decode($data, true);
$orderId = $data_arr['ORDER_ID'];
$tickNum = $data_arr['TICK_NUM'];
$tickOrderId = $data_arr['TICK_ORDER_ID'];
$totalPrice = $data_arr['TOTAL_PRICE'];

// echo $orderId;
// echo $tickNum;
// echo $tickNum;
// echo $tickOrderId;
// echo $totalPrice;

// 取得舊價錢

$getOldPrice = "SELECT TOTAL_PRICE FROM TICK_ORDER WHERE TICK_ORDER_ID = :tick_order_id";
$stmt = $pdo->prepare($getOldPrice);
$stmt->bindParam(':tick_order_id', $tickOrderId);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $result = $stmt->fetch();  // 提取結果的第一行
    $oldPrice = $result['TOTAL_PRICE'];  // 從結果中取得 TOTAL_PRICE 的值
    echo $oldPrice;
} else {

    echo "取得失敗";
}


// 更新購物車價錢
$newCartPrice = "UPDATE `ORDER` SET ORDER_PRICE = ORDER_PRICE - :old_price + :total_price WHERE ORDER_ID = :order_id";
$stmt = $pdo->prepare($newCartPrice);
$stmt->bindParam(':total_price', $totalPrice);
$stmt->bindParam(':old_price', $oldPrice);
$stmt->bindParam(':order_id', $orderId);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    
    echo "價錢更新成功";
} else {

    echo "價錢更新失敗";
}



// //建立SQL
$sql = "UPDATE TICK_ORDER SET TICK_NUM = :tick_num , TOTAL_PRICE = :total_price WHERE TICK_ORDER_ID = :tick_order_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':tick_order_id', $tickOrderId);
$stmt->bindParam(':tick_num', $tickNum);
$stmt->bindParam(':total_price', $totalPrice);

$stmt->execute();


// 回傳是否成功
if ($stmt->rowCount() > 0) {
    $status = array("status" => "true");
    $json_results = json_encode($status);
    echo "修改成功";
} else {
    $status = array("status" => "false");
    $json_results = json_encode($status);
    echo "修改失敗";
}
