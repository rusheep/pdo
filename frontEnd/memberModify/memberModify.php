<?php
include('../../Lib/conn.php');

// 建立 SQL 语句
$sql = "SELECT * FROM monsterdb.MEMBER";

$statement = $pdo->query($sql);

$data = $statement->fetchAll(PDO::FETCH_ASSOC);

$json_results = json_encode($data);

echo $json_results;
?>