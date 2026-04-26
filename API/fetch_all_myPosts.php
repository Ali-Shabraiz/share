<?php
include "../PHP/config.php";
header("Content-Type: application/json; charset=UTF-8");
if(isset($_POST['userID'])){
    $id = $_POST['userID'];
    $tableName = 'post_'.$id;
    $result = $conn->query("SELECT ID,name,data,type FROM `$tableName`  ORDER BY date");
    $rows = [];
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
}
}
else if(isset($_COOKIE['userID'])){
    $id = $_COOKIE['userID'];
    $tableName = 'post_'.$id;
    $result = $conn->query("SELECT ID,name,data,type FROM `$tableName`  ORDER BY date");
    $rows = [];
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;

    } 
    $conn->close();
    
    }
    echo json_encode($rows);
?>