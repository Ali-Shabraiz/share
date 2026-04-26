<?php
header("Content-Type: application/json; charset=UTF-8");
include "../PHP/config.php";
if(isset($_COOKIE['userID'])){
    $newData = [];
function generateUserID($length = 15) {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    return substr(str_shuffle($chars), 0, $length);
}
$Date = date("YmdHis");

$newData['ID'] = generateUserID();
$newData['comment'] = $_POST['comment'];
$newData['date'] = $Date;
$newData['on'] = $_POST['on'];
$newData['commentBy'] = $_COOKIE['userID'];



$file = "../assets/json/".$newData['on'].'.json';

// Get existing data
$currentData = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// Insert new data at the beginning
array_unshift($currentData, $newData);

// Save back to file
file_put_contents($file, json_encode($currentData, JSON_PRETTY_PRINT), LOCK_EX);
        $row = [];
        $row['date'] = date("d M Y", strtotime($newData['date']));
        $stmt = $conn->prepare("SELECT name,img FROM user WHERE ID = ?");
        $stmt->bind_param("s", $newData['commentBy']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row2 = $result->fetch_assoc();
        $row['img'] = $row2['img'];
        $row['commentBy'] = $row2['name'];
        $row['comment'] = $newData['comment'];
        $rows['code'] = 200;
        $row['comments'] = count($currentData);
        echo json_encode($row);


$stmt->close();

}
$conn->close();

        

?>