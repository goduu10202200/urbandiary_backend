<?php
include 'DBConnection.php';
$raw_post_data = json_decode(file_get_contents('php://input'), true);
    
$id =  $raw_post_data['id'];
$response_data[]="";
    //Select same student.id
    $sql = "SELECT *  FROM diary WHERE username=" .$id.  "";
    $result = $conn->query($sql);
    $rows_diary_count = mysqli_num_rows($result);

    if ($rows_diary_count !=0) {
        while ($row = $result->fetch_assoc()) {
            //user name
            $sql = "SELECT name FROM member WHERE id =" .$row['username'].    "";
            $result_username = $conn->query($sql);
            $row_username = $result_username->fetch_array();

            $response_data[] = array(
            "id"                    =>  $row['id'],
            "date"	              =>  $row['date'],
            "username"      => $row_username['name']
        );
        }
    } else {
        //user name
        $sql = "SELECT name FROM member WHERE id =" .$id.    "";
        $result_username = $conn->query($sql);
        $row_username = $result_username->fetch_array();

        $response_data[] = array(
            "id"                    =>  "10444224",
            // "date"	              =>  $row['date'],
            "username"      => $row_username['name']
        );
    }
  
    echo json_encode($response_data);
    $conn->close();
