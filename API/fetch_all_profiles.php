<?php
include "../PHP/config.php";
header("Content-Type: application/json; charset=UTF-8");
$result = $conn->query("SELECT ID,name,email,nickName,follower,following,likes,friends,sharedLinks,bio,img,whatsapp,facebook,instagram,tiktok,youtube FROM user ORDER BY dateOrder");
$rows = [];
while($row = $result->fetch_assoc()) {
    $row['scores'] = $row['follower']*5 + $row['following']*2+$row['likes']*8+$row['friends']*10+$row['sharedLinks']*15;;
    $rows[] = $row;
}
echo json_encode($rows);
$conn->close();
?>