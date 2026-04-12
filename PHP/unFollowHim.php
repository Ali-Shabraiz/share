<?php
header("Content-Type: application/json; charset=UTF-8");
include "./config.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function followText($isFollowed,$isFollowing){
            if($isFollowed == 1 && $isFollowing == 1)
                return "Unfriend";
            else if($isFollowed == 0 && $isFollowing == 1)
                return "Unfollow";
            else if($isFollowing == 0 && $isFollowed == 1)
                return "Follow Back";
            else 
                return "Follow";
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
    $isFollowed = $row1['follower'] ?? 0;
    $isFollowing = $row1['following'] ?? 0;
    $isFriend = $isFollowed && $isFollowing;
    
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



        $sql = "SELECT follower,following FROM `$tableName` WHERE fID = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $fID);
        $stmt->execute();
        $result1 = $stmt->get_result();
        $row1 = $result1->fetch_assoc();
        $isFollowed = $row1['follower'] ?? 0;
        $isFollowing = $row1['following'] ?? 0;
        $isFriend = $isFollowed && $isFollowing;
        $stmt = $conn->prepare("SELECT follower,following,friends,likes,sharedLinks FROM user WHERE ID = ? LIMIT 1");
        $stmt->bind_param("s", $fID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $row['followText'] = followText($isFollowed,$isFollowing);
        $row['isFollower'] = $isFollowed;
        $row['isFollowing'] = $isFollowing;
        $row['scores'] = $row['follower']*5 + $row['following']*2+$row['likes']*8+$row['friends']*10+$row['sharedLinks']*15;
        $row['isFriend'] = $isFriend;
        unset($row['sharedLinks']);
        echo json_encode($row);



    
    if(!$isFollowed && !$isFollowing){
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