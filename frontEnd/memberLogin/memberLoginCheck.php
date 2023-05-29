<?php
include("../../Lib/MemberCheck.php");

// 取得 session 檢查結果
$result = getMemberName();


// 將結果轉換為 JSON 格式
$jsonResult = json_encode($result);


// 輸出 JSON 字串
echo $jsonResult;

?>