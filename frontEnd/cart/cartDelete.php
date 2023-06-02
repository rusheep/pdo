<?php

include('../../Lib/conn.php');

//---------------------------------------------------
//
$data = file_get_contents("php://input");
// echo "這是php接收到的資料" . $data;

$data_arr = json_decode($data, true);
$tickOrderId = $data_arr['ticketID'];
$tickPrice = $data_arr['totalTickPrice'];
// echo $tickOrderId;
// echo $tickPrice;

// 用tickOrderId 找ORDER 的ORDER_ID
$tickOrderId = $data_arr['ticketID'];
$stmt = $pdo->prepare("SELECT ORDER_ID FROM TICK_ORDER WHERE TICK_ORDER_ID = :tickOrderId");
$stmt->bindParam(':tickOrderId', $tickOrderId);
$stmt->execute();

// 获取查询结果
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $orderID = $result['ORDER_ID'];
    // echo $orderID;
} else {
    echo "未找到訂單";
}

// 用ORDER_ID 來更訂單總改金額
$sql = "UPDATE `ORDER` SET ORDER_PRICE = ORDER_PRICE - :tickPrice WHERE ORDER_ID = :orderID";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':tickPrice', $tickPrice);
$stmt->bindParam(':orderID', $orderID);
$stmt->execute();

// 检查是否执行成功
if ($stmt->rowCount() > 0) {
    echo "金額刪除成功！";
} else {
    echo "金額刪除失敗！";
}

// include('../../Lib/conn.php');

// //---------------------------------------------------
// //
// $data = file_get_contents("php://input");
// // echo "這是php接收到的資料" . $data;

// $data_arr = json_decode($data, true);
// $tickOrderId = $data_arr['ticketID'];
// $tickPrice = $data_arr['totalTickPrice'];
// // echo $tickOrderId;
// // echo $tickPrice;

// // 用tickOrderId 找ORDER 的ORDER_ID
// $tickOrderId = $data_arr['ticketID'];
// $stmt = $pdo->prepare("SELECT ORDER_ID FROM TICK_ORDER WHERE TICK_ORDER_ID = :tickOrderId");
// $stmt->bindParam(':tickOrderId', $tickOrderId);
// $stmt->execute();

// // 获取查询结果
// $result = $stmt->fetch(PDO::FETCH_ASSOC);

// if ($result) {
//     $orderID = $result['ORDER_ID'];
//     // echo $orderID;
// } else {
//     echo "未找到訂單";
// }

// // 用ORDER_ID 來更訂單總改金額
// $sql = "UPDATE `ORDER` SET ORDER_PRICE = ORDER_PRICE - :tickPrice WHERE ORDER_ID = :orderID";
// $stmt = $pdo->prepare($sql);
// $stmt->bindParam(':tickPrice', $tickPrice);
// $stmt->bindParam(':orderID', $orderID);
// $stmt->execute();

// // 检查是否执行成功
// if ($stmt->rowCount() > 0) {
//     echo "金額刪除成功！";
// } else {
//     echo "金額刪除失敗！";
// }





// // 刪除訂單

// // //建立SQL
// $sql = "DELETE FROM TICK_ORDER WHERE TICK_ORDER_ID = :tick_order_id";
// $stmt = $pdo->prepare($sql);
// $stmt->bindParam(':tick_order_id', $tickOrderId);

// $stmt->execute();


// // 回傳是否成功
// if ($stmt->rowCount() > 0) {
//     $status = array("status" => "true");
//     $json_results = json_encode($status);
//     echo $json_results;
// } else {
//     $status = array("status" => "false");
//     $json_results = json_encode($status);
//     echo $json_results;
// }





// 刪除訂單

// //建立SQL
$sql = "DELETE FROM TICK_ORDER WHERE TICK_ORDER_ID = :tick_order_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':tick_order_id', $tickOrderId);

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
