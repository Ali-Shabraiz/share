<?php
include "./config.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function generateUserID($length = 15) {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    return substr(str_shuffle($chars), 0, $length);
}
$followId = generateUserID();

$id = $_POST['id'];
$fID = $_POST['fID'];
// $nickName = $_POST['nickName'];
$tableName = 'follow_'.$id;
$tableName2 = 'follow_'.$fID;
$follower = 0;
$following = 1;
// Folder where images will be stored

$sql = "SELECT * FROM `$tableName` WHERE fID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $fID);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($result->num_rows === 0) {
$sql = "INSERT INTO `$tableName` (ID, fID, follower, following, date) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $id, $fID, $follower, $following, $Date);
$stmt->execute();
} else {
    if($row['following'])
        $following = !$row['following'];
    $sql = "UPDATE `$tableName` SET following = ? WHERE fID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $following,$fID);
    if($stmt->execute()){
        $sql = "UPDATE `$tableName2` SET follower = ? WHERE fID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $following,$fID);
        $stmt->execute();
    }
}


$stmt->close();
$conn->close();

?>