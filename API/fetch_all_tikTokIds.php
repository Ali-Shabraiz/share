<?php
include "../PHP/config.php";
header("Content-Type: application/json; charset=UTF-8");
$result = $conn->query("SELECT * FROM accountid ORDER BY dateOrder");
$rows = [];
while($row = $result->fetch_assoc()) {
    $row['link'] = 'https://www.tiktok.com/@'.$row['idName'];
    $rows[] = $row;
}
echo json_encode($rows);
$conn->close();
?>