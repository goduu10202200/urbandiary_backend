<?php
 include 'DBConnection_mongo.php';
 $raw_post_data = json_decode(file_get_contents('php://input'), true);


  // 資料表
 $collection = 'diary';

 // 設定變數
$id =  $raw_post_data['id'];
$response_data[]="";
 

// 連線資料庫
$manager = new MongoDB\Driver\Manager("mongodb://".$dbhost);

// 查詢條件
$filter= array('username' => $id);

// 查詢資料
$query = new MongoDB\Driver\Query($filter);
$cursor = $manager->executeQuery($dbname.'.'.$collection, $query);
$count_diary = count(iterator_to_array($cursor));

// 判斷是否有資料
if ($count_diary != 0) {
    $cursor = $manager->executeQuery($dbname.'.'.$collection, $query);
    foreach ($cursor as $key =>  $document) {
        $decode_data = json_decode(json_encode($document), true);

        // 查詢條件
        $filter= array('username' => $decode_data['username']);
        $query = new MongoDB\Driver\Query($filter);
        
        // 查詢資料
        $rows = $manager->executeQuery('ud.member', $query);

        foreach ($rows as $key =>  $rows_document) {
            $decode_data2 = json_decode(json_encode($rows_document), true);
            $response_data[] = array(
                "id"                =>  $decode_data['_id'],
                "date"              =>  $decode_data['date'],
                "username"          =>  $decode_data2['name'],
                "imagefilename"     =>  $decode_data['imagefilename'],
            );
        }
    }
}

echo json_encode($response_data);
