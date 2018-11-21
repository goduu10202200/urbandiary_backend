<?php
 include 'DBConnection_mongo.php';
 $raw_post_data = json_decode(file_get_contents('php://input'), true);

  // 資料表
 $collection = 'jieba';

 // 設定變數
$id_diary =  $raw_post_data['diary'];
 
// 連線資料庫
$manager = new MongoDB\Driver\Manager("mongodb://".$dbhost);

// 查詢條件
$filter= array('diary_id' => $id_diary);

// 查詢資料
$query = new MongoDB\Driver\Query($filter);
$cursor = $manager->executeQuery($dbname.'.'.$collection, $query);

// 判斷是否有資料
foreach ($cursor as $key =>  $document) {
    $decode_data = json_decode(json_encode($document), true);

    $response_data[] = array(
            "id"                  =>   $decode_data['_id'],
            "word"              =>   $decode_data['word'],
            "sentence"         =>   $decode_data['sentence'],
    );
}

echo json_encode($response_data);
