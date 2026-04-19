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

$Date = date("Y-m-d H:i:s");
$likeID = generateUserID();

if(isset($_COOKIE['userID'])){

    $userID = $_COOKIE['userID'];
    $postID = $_POST['postID'];
    $isProfile = isset($_GET['profile']) ? 1 : 0;

    // ✅ STEP 1: Get uploadedBy + type
    if(!$isProfile){
        $stmt = $conn->prepare("SELECT uploadedBy, type FROM posts WHERE ID = ? LIMIT 1");
        $stmt->bind_param("s", $postID);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows == 0){
            echo json_encode(["error" => "Post not found"]);
            exit;
        }

        $row = $result->fetch_assoc();
        $uploadedBy = $row['uploadedBy'];
        $type = $row['type'];

    } else {
        // Profile like
        $uploadedBy = $postID;
        $type = 0;
    }

    // ✅ STEP 2: Table names
    $tableName1 = 'like_'.$userID;
    $tableName2 = 'like_'.$uploadedBy;

    // ✅ STEP 3: Check already liked
    $stmt = $conn->prepare("SELECT ID FROM `$tableName1` WHERE likedBy = ? AND liked = ?");
    $stmt->bind_param("ss", $userID, $postID);
    $stmt->execute();
    $result = $stmt->get_result();

    // =============================
    // ❤️ LIKE
    // =============================
    if($result->num_rows == 0){

        if($tableName1 != $tableName2){

            // insert user table
            $stmt = $conn->prepare("INSERT INTO `$tableName1` (ID,likedBy,liked,type,isMe,date) VALUES (?, ?, ?, ?, 1, ?)");
            $stmt->bind_param("sssis", $likeID,$userID,$postID,$type,$Date);
            $stmt->execute();

            // insert owner table
            $stmt = $conn->prepare("INSERT INTO `$tableName2` (ID,likedBy,liked,type,date) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssis", $likeID,$userID,$postID,$type,$Date);
            $stmt->execute();

            // update counts
            $stmt = $conn->prepare("UPDATE user SET likes = likes + 1 WHERE ID = ?");
            $stmt->bind_param("s", $uploadedBy);
            $stmt->execute();

            if(!$isProfile){
                $stmt = $conn->prepare("UPDATE posts SET likes = likes + 1 WHERE ID = ?");
                $stmt->bind_param("s", $postID);
                $stmt->execute();
            }

            // return updated likes
            $query = !$isProfile 
                ? "SELECT likes FROM posts WHERE ID = ?" 
                : "SELECT likes FROM user WHERE ID = ?";

            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $postID);
            $stmt->execute();
            $row = $stmt->get_result()->fetch_assoc();

            $row['condition'] = 1;
            $row['color'] = '--heartRed';
            if(isset($_GET['profile']))
            $row['scores'] = 8;

            echo json_encode($row);
        }

    } 
    // =============================
    // 💔 UNLIKE
    // =============================
    else {

        $row = $result->fetch_assoc();
        $likedID = $row['ID'];

        // delete both
        $stmt = $conn->prepare("DELETE FROM `$tableName1` WHERE ID = ?");
        $stmt->bind_param("s", $likedID);
        $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM `$tableName2` WHERE ID = ?");
        $stmt->bind_param("s", $likedID);
        $stmt->execute();

        // update counts
        $stmt = $conn->prepare("UPDATE user SET likes = likes - 1 WHERE ID = ?");
        $stmt->bind_param("s", $uploadedBy);
        $stmt->execute();

        if(!$isProfile){
            $stmt = $conn->prepare("UPDATE posts SET likes = likes - 1 WHERE ID = ?");
            $stmt->bind_param("s", $postID);
            $stmt->execute();
        }

        $query = !$isProfile 
            ? "SELECT likes FROM posts WHERE ID = ?" 
            : "SELECT likes FROM user WHERE ID = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $postID);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();

        $row['condition'] = 0;
        $row['color'] = '--blk';
        if(isset($_GET['profile']))
            $row['scores'] = -8;

        echo json_encode($row);
    }
}

$conn->close();
?>