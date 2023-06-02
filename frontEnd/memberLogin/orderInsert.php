<?php



include('../../Lib/conn.php');
include('../../Lib/MemberCheck.php');
//---------------------------------------------------
//取得memberid
getMemberName();
$member_id = $_SESSION["MemberId"];
// echo $member_id;

$data = json_decode(file_get_contents('php://input'), true);
$orderData = $data['postToDBData'];
$totalPrice = $data['total'];

$sql = "SELECT * FROM `ORDER` WHERE MEMBER_ID = :member_id AND ORDER_STATE = '購物車'";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':member_id', $member_id);
$stmt->execute();


$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$orderId = $result[0]['ORDER_ID'];

if ($stmt->rowCount() > 0) {
    // echo "有資料";
    // echo json_encode($result);

    //判斷是否是新增的票券 tickOrderId是否為null 如果是null insert 如果不是 則update
    foreach ($orderData as $item) {
        if ($item['TICK_ORDER_ID'] === null) {
            // 如果沒有 INSERT
            // 取得 TICK_ID、TICK_NUM、TICK_DATE、FAST_PASS 和 START_DATE 值
            $tickId = $item['TICK_ID'];
            $tickNum = $item['TICK_NUM'];
            $tickDate = $item['TICK_DATE'];
            $fastPass = $item['FAST_PASS'];
            $startDate = $item['START_DATE'];
            $endDate = date('Y-m-d', strtotime($startDate . ' + 7 days'));

            // 建立 SQL INSERT 语句
            $sql = "INSERT INTO TICK_ORDER (ORDER_ID, TICK_ID, TICK_NUM, TICK_DATE, FAST_PASS, START_DATE, END_DATE) VALUES (:orderId, :tickId, :tickNum, :tickDate, :fastPass, :startDate, :endDate)";

            // 准备 PDO 语句
            $stmt = $pdo->prepare($sql);

            // 綁定參數並執行語句
            $stmt->bindParam(':orderId', $orderId);
            $stmt->bindParam(':tickId', $tickId);
            $stmt->bindParam(':tickNum', $tickNum);
            $stmt->bindParam(':tickDate', $tickDate);
            $stmt->bindParam(':fastPass', $fastPass);
            $stmt->bindParam(':startDate', $startDate);
            $stmt->bindParam(':endDate', $endDate);
            $stmt->execute();

            // 檢查插入是否成功
            if ($stmt->rowCount() > 0) {
                $response = array('message' => 'TICK_ORDER 插入成功');
                echo json_encode($response);
            } else {
                $response = array('message' => 'TICK_ORDER 插入失敗');
                echo json_encode($response);
            }
        } else {
            // 其他處理邏輯...
            // 沒有新增資料 update

            $tickOrderId = $item['TICK_ORDER_ID'];
            $tickId = $item['TICK_ID'];
            $tickNum = $item['TICK_NUM'];
            $tickDate = $item['TICK_DATE'];
            $fastPass = $item['FAST_PASS'];
            $startDate = $item['START_DATE'];
            $endDate = date('Y-m-d', strtotime($startDate . '+7 days'));
    
            // 更新 TICK_ORDER 表数据
            $sql = "UPDATE TICK_ORDER SET TICK_ID = :tick_id, TICK_NUM = :tick_num, TICK_DATE = :tick_date, FAST_PASS = :fast_pass, START_DATE = :start_date, END_DATE = :end_date WHERE TICK_ORDER_ID = :tick_order_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':tick_id', $tickId);
            $stmt->bindParam(':tick_num', $tickNum);
            $stmt->bindParam(':tick_date', $tickDate);
            $stmt->bindParam(':fast_pass', $fastPass);
            $stmt->bindParam(':start_date', $startDate);
            $stmt->bindParam(':end_date', $endDate);
            $stmt->bindParam(':tick_order_id', $tickOrderId);
            $stmt->execute();
    
            // 检查更新是否成功
            if ($stmt->rowCount() > 0) {
                $response = array('message' => 'TICK_ORDER 更新成功');
                echo json_encode($response);
            } else {
                $response = array('message' => 'TICK_ORDER 更新失敗');
                echo json_encode($response);
            }
        }
    }
} else {
    echo "沒有資料";

    $order_state = "購物車";

    $sql = "INSERT INTO `ORDER` (MEMBER_ID, ORDER_STATE, ORDER_TIME) VALUES (:member_id, :order_state, NOW())";

    // 準備 PDO 語句
    $stmt = $pdo->prepare($sql);

    // 綁定參數並執行語句
    $stmt->bindParam(':member_id', $member_id);
    $stmt->bindParam(':order_state', $order_state);
    $stmt->execute();

    // 檢查插入是否成功
    if ($stmt->rowCount() > 0) {
        $response = array('message' => '訂單插入成功');
        echo json_encode($response);
    } else {
        $response = array('message' => '訂單插入失敗');
        echo json_encode($response);
    }
}

