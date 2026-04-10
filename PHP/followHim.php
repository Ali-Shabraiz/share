<?php
header("Content-Type: application/json; charset=UTF-8");
include "./config.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function generateUserID($length = 15) {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    return substr(str_shuffle($chars), 0, $length);
}
function followText($isFollowed,$isFollowing){
            if($isFollowed && $isFollowing)
                return "Unfriend";
            else if($isFollowed == 0 && $isFollowing == 1)
                return "Unfollow";
            else if($isFollowing == 0 && $isFollowed == 1)
                return "Follow Back";
            else 
                return "Follow";
        }
$followId = generateUserID();

$id = $_COOKIE['userID'];
$fID = $_POST['fID'];
$tableName = 'follow_'.$id;
$tableName2 = 'follow_'.$fID;
$follower = 0;
$following = 1;

$sql = "SELECT * FROM `$tableName` WHERE fID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $fID);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($result->num_rows === 0) {
$sql = "INSERT INTO `$tableName` (ID, fID, follower, following, date) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssiis", $followId, $fID, $follower, $following, $Date);
if($stmt->execute()){
$stmt = $conn->prepare("UPDATE user SET following = following+1 WHERE ID = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
}
$follower = 1;
$following = 0;
$sql = "INSERT INTO `$tableName2` (ID, fID, follower, following, date) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssiis", $followId, $id, $follower, $following, $Date);
if($stmt->execute()){
$stmt = $conn->prepare("UPDATE user SET follower = follower+1 WHERE ID = ?");
$stmt->bind_param("s", $fID);
$stmt->execute();
}
} else {
    $following = 1;
    $follower = 1;
$sql = "UPDATE `$tableName` SET following = ? WHERE fID = ? AND following = 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $following,$fID);
$stmt->execute();
$affected_row = $stmt->affected_rows;
if($affected_row != 0){
$stmt = $conn->prepare("UPDATE user SET following = following+1 WHERE ID = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
}

$sql = "UPDATE `$tableName2` SET follower = ? WHERE fID = ? AND follower = 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $follower,$id);
$stmt->execute(); 
$affected_row = $stmt->affected_rows;
if($affected_row != 0){
$stmt = $conn->prepare("UPDATE user SET follower = follower+1 WHERE ID = ?");
$stmt->bind_param("s", $fID);
$stmt->execute();
}
    $sql = "SELECT follower,following FROM `$tableName` WHERE fID = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $fID);
    $stmt->execute();
    $result1 = $stmt->get_result();
    $row1 = $result1->fetch_assoc();
    if($row1['follower'] && $row1['following']){
        $stmt = $conn->prepare("UPDATE user SET friends  = friends + 1 WHERE ID = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt = $conn->prepare("UPDATE user SET friends  = friends + 1 WHERE ID = ?");
        $stmt->bind_param("s", $fID);
        $stmt->execute();
    }
}

        $stmt = $conn->prepare("SELECT follower,following,friends FROM user WHERE ID = ? LIMIT 1");
        $stmt->bind_param("s", $fID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $row['followText'] = followText($follower,$following);
        echo json_encode($row);

$stmt->close();
$conn->close();
?>