<?php
include('../../Lib/conn.php');


//--------------------------------------------------


$data = file_get_contents("php://input");
// echo "這是php接收到的資料" .$data;
$data_arr = json_decode($data, true);


$account = $data_arr['account'];
$pwd = $data_arr['pwd'];


//建立SQL語法
$sql = "SELECT * FROM MEMBER
        WHERE ACCOUNT = :account AND PASSWORD = :pwd";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":account", $account);
$stmt->bindParam(":pwd", $pwd);
$stmt->execute();


//檢查結果
$num = $stmt->fetchAll(); // 函式返回結果集中行的數量



if ($num > 0) {
  //登入成功，設定SESSION變數


  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $memberStatus = "true";


  include("../../Lib/MemberCheck.php");
  //將登入資訊寫入session
  setMemberInfo($account,$memberStatus);
  echo $_SESSION["MemberStatus"];
  
} else {
  echo "登入失敗";
}
