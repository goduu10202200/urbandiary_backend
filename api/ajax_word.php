<?php
include 'DBConnection.php';
$raw_post_data = json_decode(file_get_contents('php://input'), true);
    
$id_diary =  $raw_post_data['diary'];
    //Select same student.id
    $sql = "SELECT *  FROM jieba WHERE diary_id=" .$id_diary.  "";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $response_data[] = array(
            "id"                    =>  $row['id'],
            "word"	             =>   $row['word'],
            "sentence"         =>  $row['sentence']
        );
    }
    echo json_encode($response_data);
    $conn->close();
