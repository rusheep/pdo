<?php
        include('../Lib/conn.php');

       //---------------------------------------------------

       //建立SQL語法
       $sql = "SELECT * 
       FROM monsterdb.TICK MT
       JOIN monsterdb.TICK_ORDER MTO ON MTO.TICK_ID = MT.TICK_ID
       JOIN monsterdb.MEMBER MM ON MM.MEMBER_ID = MTO.TICK_ORDER_ID";

    
        $statement = $pdo->query($sql);

        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        $json_results = json_encode($data);

        echo $json_results;
?>