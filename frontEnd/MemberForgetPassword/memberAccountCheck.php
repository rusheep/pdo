<?php
include('../../Lib/conn.php');


//--------------------------------------------------


$data = file_get_contents("php://input");
// echo "這是php接收到的資料" .$data;
$data_arr = json_decode($data, true);


$account = $data_arr['account'];
$name = $data_arr['name'];


//建立SQL語法
$sql = "SELECT * FROM MEMBER
        WHERE (PHONE = :account or EMAIL =:account or ACCOUNT = :account) AND NAME = :name";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":account", $account);
$stmt->bindParam(":name", $name);
$stmt->execute();


//檢查結果
// $num = $stmt->rowCount(); // 函式返回結果集中行的數量
$num = $stmt->fetchAll();

//3
if (count($num) > 0) {
  // // $result = $stmt->fetch(PDO::FETCH_ASSOC);

  $memberStatus = "true";
  include("../../Lib/MemberCheck.php");
  //   //將登入資訊寫入session
  getMemberAccount($account, $memberStatus);
  // echo $_SESSION["MemberStatus"];
  echo "確認已有資料";
} else {
  echo "無此帳號密碼";
}
