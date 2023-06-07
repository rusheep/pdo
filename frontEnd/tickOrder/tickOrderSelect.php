<?php
        
        include('../../Lib/conn.php');
        include('../../Lib/MemberCheck.php');
        
        //---------------------------------------------------
        
        //取得登入的帳號
        getMemberName();
        $account = $_SESSION["MemberAccount"];
        $memberId = $_SESSION["MemberId"];
        
        // 查詢ORDER
        $query1 = "SELECT * FROM `ORDER` WHERE MEMBER_ID = :member_id AND ORDER_STATE = '已完成'";
        $stmt = $pdo->prepare($query1);
        $stmt->bindParam(':member_id', $memberId);
        $stmt->execute();
        
        $orderIds = array();
        $rows = array(); // 初始化 $rows 陣列
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $orderIds[] = $row['ORDER_ID'];
        }
        
        foreach ($orderIds as $orderId) {
            $orderIdsString = $orderId;
            $query2 = "SELECT * FROM TICK_ORDER WHERE ORDER_ID IN ($orderIdsString)";
            $result2 = $pdo->query($query2);
        
            while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
                $rows[] = $row;
            }
        }
        
        echo json_encode($rows);
        
?>