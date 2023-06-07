<?php
include('../../Lib/conn.php');

// 查詢RIDE_STATUS
$sql = "SELECT * FROM RIDES_TABLE";
$stmt = $pdo->prepare($sql);

if ($stmt->execute()) {
    // 成功執行查詢
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // 將查詢的資料轉換為 JSON 格式並輸出
    echo json_encode($result);
} else {
    // 查詢執行失敗
    echo "查詢失敗";
}
?>
