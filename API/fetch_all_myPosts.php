<?php
include "../PHP/config.php";
header("Content-Type: application/json; charset=UTF-8");
if(isset($_COOKIE['userID'])){
    $id = $_COOKIE['userID'];
    $tableName = 'post_'.$id;
    $result = $conn->query("SELECT ID,name,data,type FROM `$tableName` WHERE ID != '$id' ORDER BY date");
    $rows = [];
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;

    }
echo json_encode($rows);
$conn->close();

}
?>