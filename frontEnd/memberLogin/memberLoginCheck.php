<?php
include("../../Lib/MemberCheck.php");

//回傳session檢查結果
echo getMemberAccount();

$account ='';
$pwd = '';

// 取得 session 檢查結果
$result = getMemberAccount($account,$pwd);
// $result = setMemberInfo($account,$pwd);


// 將結果轉換為 JSON 格式
$jsonResult = json_encode($result);


// 輸出 JSON 字串
echo $jsonResult;

?>