<?php

    include('../Lib/conn.php'); 

    //---------------------------------------------------

        $member_id = 11;

        //建立SQL
        $sql = "SELECT * FROM monsterdb.TICK_ORDER WHERE MEMBER_ID = $member_id";
        $stmt = $pdo->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json_results = json_encode($data);
        echo $json_results;

?>