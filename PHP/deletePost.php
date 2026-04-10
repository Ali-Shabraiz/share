<?php
include "./config.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_COOKIE['userID'])){
    $userID = $_COOKIE['userID'];
    $postID = $_POST['postID'];
    $tableName = 'post_'.$userID;
    $sql = "DELETE FROM `$tableName` WHERE ID = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $postID);
    $stmt->execute();
    $stmt = $conn->prepare("DELETE FROM posts WHERE ID = ? LIMIT 1");
    $stmt->bind_param("s", $postID);
    $stmt->execute();
    $stmt->close();
    $stmt = $conn->prepare("UPDATE user SET sharedLinks = sharedLinks - 1 WHERE ID = ?");
    $stmt->bind_param("s", $userID);
    $stmt->execute();
}

$conn->close();
?>