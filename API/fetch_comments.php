<?php
include "../PHP/config.php";
header("Content-Type: application/json; charset=UTF-8");
if(isset($_COOKIE['userID'])){
    function generateUserID($length = 15) {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    return substr(str_shuffle($chars), 0, $length);
    }
    $userID = $_COOKIE['userID'];
    $postID = $_POST['postID'];
    $fileAddress  = '../assets/json/'.$postID.'.json';
    if(file_exists($fileAddress)){
    $json = file_get_contents($fileAddress);
    $data = json_decode($json, true);
    $rows = [];
    $comments = [];
    
    foreach ($data as $item) {
        $row['date'] = date("d M Y", strtotime($item['date']));
        $stmt = $conn->prepare("SELECT name,img FROM user WHERE ID = ?");
        $stmt->bind_param("s", $item['commentBy']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row2 = $result->fetch_assoc();
        $row['img'] = $row2['img'];
        $row['commentBy'] = $row2['name'];
        $row['comment'] = $item['comment'];
        $rows['code'] = 200;
        $comments[] = $row;
        $stmt->close();
} 
    $rows['message'] = $comments;
    } else {
        $rows['message'] = "No comment Found";
        $rows['code'] = 404;
        
    }

echo json_encode($rows);
}
$conn->close();
    ?>