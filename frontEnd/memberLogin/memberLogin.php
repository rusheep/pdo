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
        WHERE (PHONE = :account or EMAIL =:account or ACCOUNT = :account) AND PASSWORD = :pwd";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":account", $account);
$stmt->bindParam(":pwd", $pwd);
$stmt->execute();



//檢查結果
// $num = $stmt->rowCount(); // 函式返回結果集中行的數量
$num = $stmt->fetchAll();

//3
if (count($num) > 0) {
  // // $result = $stmt->fetch(PDO::FETCH_ASSOC);

  $memberStatus = "true";
  $member_id = $num[0]['MEMBER_ID'];
  include("../../Lib/MemberCheck.php");
  //   //將登入資訊寫入session
  setMemberInfo($account, $memberStatus,$member_id);
  // echo $_SESSION["MemberStatus"];
  echo "登入成功";
} else {
  echo "登入失敗";
}
