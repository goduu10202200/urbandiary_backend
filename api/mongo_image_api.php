<?php
include 'DBConnection_mongo.php';
$raw_post_data = json_decode(file_get_contents('php://input'), true);


  // 資料表
$collection = 'diary';

// 設定變數
$i = 0;
$k = 0;
$filename = "";
$id_diary =  $raw_post_data['diary'];

// 連線資料庫
$manager = new MongoDB\Driver\Manager("mongodb://".$dbhost);

// 查詢條件
$filter= array('_id' => new \MongoDB\BSON\ObjectID($id_diary));
// 查詢資料
$query = new MongoDB\Driver\Query($filter);
$cursor = $manager->executeQuery($dbname.'.'.$collection, $query);

// 判斷是否有資料
foreach ($cursor as $key =>  $document) {
    $decode_data = json_decode(json_encode($document), true);
    $filename = $decode_data['imagefilename'];
    $i = $i +1;
}

if ($i > 0) {
    // 資料表
    $collection2 = 'imagga';
    // 查詢條件
    $filter2 = array('filename' => $filename);
    // 查詢資料
    $query2 = new MongoDB\Driver\Query($filter2);
    $cursor2 = $manager->executeQuery($dbname.'.'.$collection2, $query2);
    // 判斷是否有資料
    foreach ($cursor2 as $key =>  $document) {
        $decode_data = json_decode(json_encode($document), true);
        $response_data[] = array(
            "filename"             =>   $decode_data['filename'],
            "resault"              =>   $decode_data['resault'],
        );
        $k = $k +1;
    }
    
    if ($k > 0) {
        echo json_encode($response_data);
    } else {
        echo "No data";
    }
} else {
    echo "No image data";
}
