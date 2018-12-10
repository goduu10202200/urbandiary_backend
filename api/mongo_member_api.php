<?php
 include 'DBConnection_mongo.php';
 $raw_post_data = json_decode(file_get_contents('php://input'), true);

  // 資料表
 $collection = 'member';
 
// 連線資料庫
$manager = new MongoDB\Driver\Manager("mongodb://".$dbhost);

// 查詢資料
$query = new MongoDB\Driver\Query([]);
$cursor = $manager->executeQuery($dbname.'.'.$collection, $query);

// 判斷是否有資料
foreach ($cursor as $key =>  $document) {
    $decode_data = json_decode(json_encode($document), true);

    $filter= array('username' => $decode_data['username']);
    $query = new MongoDB\Driver\Query($filter);
    $rows = $manager->executeQuery('ud.diary', $query);
    $decode_data2 = iterator_to_array($rows);

    $response_data[] = array(
        "id"                =>   $decode_data['_id'],
        "username"          =>   $decode_data['username'],
        "name"              =>   $decode_data['name'],
        "diary_count"	    =>  count($decode_data2),
    );
}
echo json_encode($response_data);
