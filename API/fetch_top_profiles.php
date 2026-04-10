<?php
include "../PHP/config.php";
header("Content-Type: application/json; charset=UTF-8");
if(isset($_COOKIE['userID'])){
    $id = $_COOKIE['userID'];
    $tableName = 'follow_'.$id;
    $result = $conn->query("SELECT ID,name,email,img,(follower*5 + following*2 + likes*8 + friends*10 + sharedLinks*15) AS scores FROM user WHERE ID != '$id' ORDER BY scores DESC LIMIT 7");
$rows = [];
while($row = $result->fetch_assoc()) {
    $fID = $row['ID'];
    // $row['scores'] = $row['follower']*5 + $row['following']*2+$row['likes']*8+$row['friends']*10+$row['sharedLinks']*15;
    $sql = "SELECT follower,following FROM `$tableName` WHERE fID = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $fID);
    $stmt->execute();
    $result1 = $stmt->get_result();
    $row1 = $result1->fetch_assoc();
    if($result1->num_rows){
    $row['isFollowed'] = $row1['follower'];
    $row['isFollowing'] = $row1['following'];
    if($row['isFollowed'] && $row['isFollowing'])
        $row['isfriend'] = 1;
    else
        $row['isFriend'] = 0;
    } else {
        $row['isFollowed'] = 0;
        $row['isFollowing'] = 0;
        $row['isFriend'] = 0;
    }
    
    $rows[] = $row;
}
echo json_encode($rows);
$stmt->close();
$conn->close();
}
?>