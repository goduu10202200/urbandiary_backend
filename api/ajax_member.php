<?php
include 'DBConnection.php';

    //Select same student.id
    $sql = "SELECT *  FROM member  ";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $sql = "SELECT COUNT(id) AS diary_count  FROM diary WHERE username = ".$row['id']. " ";
        $result_count = $conn->query($sql);
        $rows_count = $result_count->fetch_array();
        $response_data[] = array(
            "id"		              =>  $row['id'],
            "username"          =>  $row['username'],
            "name"	               =>  $row['name'],
            "diary_count"       =>  $rows_count['diary_count']
        );
    }
    echo json_encode($response_data);
    $conn->close();
