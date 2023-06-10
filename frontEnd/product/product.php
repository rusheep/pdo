<?php
include('../../Lib/conn.php');

//---------------------------------------------------

//建立SQL語法
$sql = "select * from PRODUCT p
join SIZE_TABLE s
on p.PRODUCT_SIZE_ID = s.SIZE_ID
order by PRODUCT_ID;";

$statement = $pdo->query($sql);

$data = $statement->fetchAll(PDO::FETCH_ASSOC);

$json_results = json_encode($data);

echo $json_results;
