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
$likeID = generateUserID();



if(isset($_COOKIE['userID'])){
    $userID = $_COOKIE['userID'];
    $postID = $_POST['postID'];
    $isProfile = 0;
    if(!isset($_GET['profile'])){
    $stmt = $conn->prepare("SELECT type,uploadedBy FROM posts WHERE ID = ? LIMIT 1");
    $stmt->bind_param("s", $postID);
    $stmt->execute();
    $result = $stmt->get_result();
    $isProfile = 1;
    if($result->num_rows == 0)
        $stmt = $conn->prepare("SELECT ID FROM user WHERE ID = ? LIMIT 1");
    }
    
    else {
        $stmt = $conn->prepare("SELECT ID FROM user WHERE ID = ? LIMIT 1");
    }
    $stmt->bind_param("s", $postID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if($result->num_rows > 0){
        if(!isset($_GET['profile'])){
            if(!$isProfile){
        $uploadedBy = $row['uploadedBy'];
        $type = $row['type'];
            } else {
                $uploadedBy = $postID;
                $type = 0;
            }
        }
        else{
        $uploadedBy = $postID;
        $type = 0;
        }
        
        $tableName1 = 'like_'.$userID;
        $tableName2 = 'like_'.$uploadedBy;
        if($isProfile)
            $tableName2 = 'like_'.$postID;
        $sql = "SELECT ID,liked,likedBy FROM `$tableName1` WHERE likedBy = ? AND liked = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $userID,$postID);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 0){
        if($tableName1 != $tableName2){
            $isMe = 1;
            $sql = "INSERT INTO `$tableName1` (ID,likedBy,liked,type,isMe,date) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssiis", $likeID,$userID,$postID,$type,$isMe,$Date);
            $stmt->execute();
            $sql = "INSERT INTO `$tableName2` (ID,likedBy,liked,type,date) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssis", $likeID,$userID,$postID,$type,$Date);
            $stmt->execute();
            $stmt = $conn->prepare("UPDATE user SET likes = likes + 1 WHERE ID = ? LIMIT 1");
            $stmt->bind_param("s", $uploadedBy);
            $stmt->execute();
            $stmt = $conn->prepare("UPDATE posts SET likes = likes + 1 WHERE ID = ? LIMIT 1");
            $stmt->bind_param("s", $postID);
            $stmt->execute();
           if(!isset($_GET['profile']))
            $stmt = $conn->prepare("SELECT likes FROM posts WHERE ID = ? LIMIT 1");
                else 
                $stmt = $conn->prepare("SELECT likes FROM user WHERE ID = ? LIMIT 1");
            $stmt->bind_param("s", $postID);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $row['condition'] = 1;
            $row['color'] = '--heartRed';
                if(isset($_GET['profile']))
            $row['scores'] = 8;
            echo json_encode($row);

        

        }
        } else {
            $row = $result->fetch_assoc();
            $likedBy = $row['likedBy'];
            $likedID = $row['ID'];
            $liked = $row['liked'];
            $sql = "DELETE FROM `$tableName1` WHERE ID = ? LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $likedID);
            $stmt->execute();
            $sql = "DELETE FROM `$tableName2` WHERE ID = ? limit 1";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $likedID);
            $stmt->execute();
            $stmt = $conn->prepare("UPDATE user SET likes = likes - 1 WHERE ID = ? LIMIT 1");
            $stmt->bind_param("s", $uploadedBy);
            $stmt->execute();
            $stmt = $conn->prepare("UPDATE posts SET likes = likes - 1 WHERE ID = ? LIMIT 1");
            $stmt->bind_param("s", $postID);
            $stmt->execute();
                if(!isset($_GET['profile']))
            $stmt = $conn->prepare("SELECT likes FROM posts WHERE ID = ? LIMIT 1");
                else 
                $stmt = $conn->prepare("SELECT likes FROM user WHERE ID = ? LIMIT 1");

            $stmt->bind_param("s", $postID);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $row['condition'] = 0;
            $row['color'] = '--blk';
                if(isset($_GET['profile']))
            $row['scores'] = -8;
            echo json_encode($row);
        }
    }
}

$stmt->close();
$conn->close();

?>