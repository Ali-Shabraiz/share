<?php
include "../PHP/config.php";
header("Content-Type: application/json; charset=UTF-8");
if(isset($_COOKIE['userID'])){
    function generateUserID($length = 15) {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    return substr(str_shuffle($chars), 0, $length);
    }
    $userID = $_COOKIE['userID'];
    $viewPosts = [];
    
    if(!isset($_GET['likePage'])){
        if(isset($_GET['firstReq'])){
            $viewPosts = ['dummy_id'];
            $storeViewedPostInJSON = "['dummy_id']";
            $stmt = $conn->prepare("UPDATE user SET viewedPosts = ?  WHERE ID = ? limit 1");
            $stmt->bind_param("ss", $storeViewedPostInJSON,$userID);
            $stmt->execute();
    }
    else {
        $stmt = $conn->prepare("SELECT viewedPosts FROM user WHERE ID = ? limit 1");
        $stmt->bind_param("s", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $viewPosts = json_decode($row['viewedPosts']);
        
        }
    }
    else {
            $viewPosts = "['dummy_id']";
            $likeTable = "like_".$userID;
        
    }
    if(!isset($_GET['likePage'])){
        $viewPostsimplode = "'" . implode("','", $viewPosts) . "'";
        $result = $conn->query("SELECT ID, type, uploadedBy,likes FROM posts WHERE ID NOT IN ($viewPostsimplode) AND ID !=  '$userID' AND uploadedBy != '$userID' ORDER BY RAND() LIMIT 5");
    }
    else {
        $result = $conn->query("SELECT liked as ID, type FROM `$likeTable` WHERE isMe = 1 AND type != 0 ORDER BY RAND()");

    }
        $rows = [];
    while($row = $result->fetch_assoc()) {
       
        $postID = $row['ID'];
        if(isset($_GET['likePage'])){
        $result4 = $conn->query("SELECT likes,uploadedBy FROM posts WHERE ID = '$postID' LIMIT 1");
        $row4 = $result4->fetch_assoc();
        
        $row['likes'] = $row4['likes'];
        $row['uploadedBy'] = $row4['uploadedBy'];
        
        } else {
        $viewPosts[] = $postID;
        $storeViewedPostInJSON = json_encode($viewPosts);
        $stmt = $conn->prepare("UPDATE user SET viewedPosts = ?  WHERE ID = ? limit 1");
        $stmt->bind_param("ss", $storeViewedPostInJSON,$userID);
        $stmt->execute();
        }
        $uploadedBy = $row['uploadedBy'];
        $tableName = 'post_'.$uploadedBy;
        $row['postID'] = generateUserID();
        $result1 = $conn->query("SELECT data,name,message,date FROM `$tableName`  WHERE ID = '$postID' ORDER BY RAND()  LIMIT 1");
        $row1 = $result1->fetch_assoc();
        $result2 = $conn->query("SELECT name,img FROM `user`  WHERE ID = '$uploadedBy'   LIMIT 1");
        $row2 = $result2->fetch_assoc();
        $row['data'] = $row1['data'];
        $row['dataName'] = $row1['name'];
        $row['message'] = $row1['message'];
        $row['name'] = $row2['name'];
        $row['img'] = $row2['img'];
        $row['uID'] = $uploadedBy;
        $row['date'] = date("d M Y", strtotime($row1['date']));
        $followTable = 'follow_'.$userID;

        $sql = "SELECT follower,following FROM `$followTable` WHERE fID = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $uploadedBy);
        $stmt->execute();
        $result3 = $stmt->get_result();
        $row3 = $result3->fetch_assoc();
        if($result3->num_rows){
            $row['isFollowed'] = $row3['follower'];
        $row['isFollowing'] = $row3['following'];
        if($row['isFollowed'] && $row['isFollowing'])
            $row['isfriend'] = 1;
        else
            $row['isFriend'] = 0;
        } else {
        $row['isFollowed'] = 0;
        $row['isFollowing'] = 0;
        $row['isFriend'] = 0;
    }
    $likeTable = 'like_'.$userID;

        $sql = "SELECT isMe FROM `$likeTable` WHERE liked = ? AND isME = 1 LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $postID);
        $stmt->execute();
        $result2 = $stmt->get_result();
        $row3 = $result2->fetch_assoc();
        if($result2->num_rows > 0)
            $row['likebyMe'] = $row3['isMe'];
        else
            $row['likebyMe'] = 0;
        
        $rows[] = $row;
    }
    
   
echo json_encode($rows);
$conn->close();

}
?>