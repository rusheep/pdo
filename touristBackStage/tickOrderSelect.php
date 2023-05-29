<?php
        include('../Lib/conn.php');

       //---------------------------------------------------

       $account_id = 9;
       $query1 = "SELECT * FROM monsterdb.ORDER WHERE MEMBER_ID = $account_id";
       $result1 = $pdo->query($query1);
       $orderIds = array();

        while ($row = $result1->fetch(PDO::FETCH_ASSOC)) {
        $orderIds[] = $row['ORDER_ID'];
        };

        foreach ($orderIds as $orderId) {
                // echo "ORDER_ID: " . $orderId . "<br>";
                // 可以在此處執行進一步的查詢，使用 $orderId 作為條件

                $orderIdsString = $orderId; // 使用當前的訂單 ID
                $query2 = "SELECT * FROM TICK_ORDER WHERE ORDER_ID IN ($orderIdsString)";
                $result2 = $pdo->query($query2);
            
                while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
                        $rows[] = $row;
                }
                
        };
        
        echo json_encode($rows);
?>