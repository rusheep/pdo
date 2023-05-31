<?php
include('../../Lib/conn.php');

// 建立 SQL 语句
$sql = "SELECT * FROM MEMBER";

// 执行查询，返回查询结果的对象
$statement = $pdo->query($sql);

// 使用 fetchAll() 方法获取所有数据
$data = $statement->fetchAll(PDO::FETCH_ASSOC);

// 将查询结果转换为 JSON 格式
$data_arr = json_decode($data, true);

// 返回 JSON 数据
echo $json_results;
?>