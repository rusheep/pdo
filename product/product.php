<?php
//MySQL相關資訊
$db_host = "127.0.0.1";
$db_user = "root";
$db_pass = "password";
$db_select = "monsterdb";

//建立資料庫連線物件
$dsn = "mysql:host=" . $db_host . ";dbname=" . $db_select . ";charset=utf8";

//建立PDO物件，並放入指定的相關資料
$pdo = new PDO($dsn, $db_user, $db_pass);

//---------------------------------------------------

//建立SQL語法
$sql = "select * from monsterdb.PRODUCT p
join monsterdb.SIZE_TABLE s
on p.PRODUCT_SIZE_ID = s.SIZE_ID
order by PRODUCT_ID;";

$statement = $pdo->query($sql);

$data = $statement->fetchAll(PDO::FETCH_ASSOC);

$json_results = json_encode($data);

echo $json_results;
