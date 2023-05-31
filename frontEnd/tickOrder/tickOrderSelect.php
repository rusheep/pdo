<?php
        
        include('../../Lib/conn.php');
        include('../../Lib/MemberCheck.php');
        //---------------------------------------------------
        
        //取得登入的帳號
        getMemberName();
        $account=$_SESSION["MemberAccount"];

        // 用登入的帳號查詢MEMBER_ID
        $query2 = "SELECT MEMBER_ID FROM MEMBER WHERE ACCOUNT = :account";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->bindParam(':account', $account);
        $stmt2->execute();

        // 取出來本來是String 把結果轉成int
        $result2 = intval($stmt2->fetch(PDO::FETCH_ASSOC)['MEMBER_ID']);
        
        // 查詢ORDER
       $query1 = "SELECT * FROM `ORDER` WHERE MEMBER_ID = $result2";
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