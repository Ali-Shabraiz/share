<?php
include "../PHP/config.php";
header("Content-Type: application/json; charset=UTF-8");
if(isset($_COOKIE['userID'])){
    $id = $_COOKIE['userID'];
    $result = $conn->query("SELECT ID, type, uploadedBy 
    FROM (
        SELECT ID, type, uploadedBy 
        FROM posts 
        ORDER BY ID ASC
        LIMIT 5
    ) AS temp
    ORDER BY RAND()
");
    $rows = [];
    while($row = $result->fetch_assoc()) {
        $uploadedBy = $row['uploadedBy'];
        $tableName = 'post_'.$uploadedBy;
        $id = $row['ID'];
        $result1 = $conn->query("SELECT data,name,date FROM `$tableName`  WHERE ID = '$id' ORDER BY RAND()  LIMIT 1");
        $row1 = $result1->fetch_assoc();
        $result2 = $conn->query("SELECT name,img FROM `user`  WHERE ID = '$uploadedBy'   LIMIT 1");
        $row2 = $result2->fetch_assoc();
        $row['data'] = $row1['data'];
        $row['dataName'] = $row1['name'];
        $row['name'] = $row2['name'];
        $row['img'] = $row2['img'];
        $row['date'] = date("d M Y", strtotime($row1['date']));
        $rows[] = $row;

    }
echo json_encode($rows);
$conn->close();

}
?>