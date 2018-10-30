<?php
include 'DBConnection.php';
$raw_post_data = json_decode(file_get_contents('php://input'), true);
    
$id =  $raw_post_data['id'];
$response_data[]="";
    //Select same student.id
    $sql = "SELECT *  FROM diary WHERE username=" .$id.  "";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $response_data[] = array(
            "id"                    =>  $row['id'],
            "date"	              =>  $row['date'],
        );
    }
    echo json_encode($response_data);
    $conn->close();
