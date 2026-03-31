<?php
include "./config.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$bio = $_POST['bio'];
$id = $_POST['ID'];
$nickName = $_POST['nickName'];
// Folder where images will be stored

$stmt = $conn->prepare("UPDATE user SET bio = ?, nickName = ? WHERE BINARY ID = ?");
    $stmt->bind_param("sss", $bio, $nickName, $id);
    $stmt->execute();


    $stmt->close();
$conn->close();

?>