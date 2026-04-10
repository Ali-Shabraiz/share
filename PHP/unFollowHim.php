<?php
include "./config.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if($_COOKIE['userID']){
    
$following = 0;
$follower = 0;
$id = $_COOKIE['userID'];
$fID = $_POST['fID'];
$tableName = 'follow_'.$id;
$tableName2 = 'follow_'.$fID;


    $sql = "SELECT follower,following FROM `$tableName` WHERE fID = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $fID);
    $stmt->execute();
    $result1 = $stmt->get_result();
    $row1 = $result1->fetch_assoc();

$isFriend = $row1['follower'] && $row1['following'];
if($isFriend){
        $stmt = $conn->prepare("UPDATE user SET friends  = friends - 1 WHERE ID = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt = $conn->prepare("UPDATE user SET friends  = friends - 1 WHERE ID = ?");
        $stmt->bind_param("s", $fID);
        $stmt->execute();
}


$sql = "UPDATE `$tableName` SET following = ? WHERE fID = ? AND following = 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $following,$fID);
$stmt->execute();
$affected_row = $stmt->affected_rows;
if($affected_row != 0){
$stmt = $conn->prepare("UPDATE user SET following = following - 1 WHERE ID = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
}



$sql = "UPDATE `$tableName2` SET follower = ? WHERE fID = ? AND follower = 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $follower,$id);
$stmt->execute(); 
$affected_row = $stmt->affected_rows;
if($affected_row != 0){
$stmt = $conn->prepare("UPDATE user SET follower = follower - 1 WHERE ID = ?");
$stmt->bind_param("s", $fID);
$stmt->execute();
       
}



    
    if(!$row1['follower'] && !$row1['following']){
        $sql = "DELETE FROM `$tableName` WHERE fID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$fID);
        $stmt->execute();
        $sql = "DELETE FROM `$tableName2` WHERE fID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$id);
        $stmt->execute();
    }
}
    


$conn->close();
?>