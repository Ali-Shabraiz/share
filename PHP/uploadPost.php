<?php
include "./config.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_COOKIE['userID'])){
function generateUserID($length = 15) {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    return substr(str_shuffle($chars), 0, $length);
}

$postID = generateUserID();
$name = $_POST['name'];
$id = $_COOKIE['userID'];
$type = $_POST['type'];
$message = $_POST['message'];
$tableName = 'post_'.$id;
$folderAddressNew = '../assets/image/';



if(isset($_POST['data'])){
    $data = $_POST['data'];
    $sql = "INSERT INTO `$tableName` (ID, name, data,type, uploadedBy,message, date) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisss", $postID, $name,$data,$type,$id,$message,$Date);
    $stmt->execute();
    $stmt = $conn->prepare("INSERT INTO posts (ID, type, uploadedBy, date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sisi", $postID,$type,$id,$Date);
    $stmt->execute();
    $stmt = $conn->prepare("UPDATE user SET sharedLinks = sharedLinks + 1 WHERE ID = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();

}




if (isset($_FILES["image"])) {
    
    
$fileTmp  = $_FILES["image"]["tmp_name"];
$fileName = $_FILES["image"]["name"];

$ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));


// Allowed formats
$allowed = ["png","jpg","jpeg","webp","svg","gif"];

// Validate extension
if (!in_array($ext, $allowed)) {
    exit("Invalid file type — allowed: png, jpg, jpeg, webp, svg, gif");
}

// Optional: max 5MB
if ($_FILES["image"]["size"] > 10 * 1024 * 1024) {
    exit("File too large (max 10MB)");
}

// Generate unique file name
$newName = uniqid("img_", true) . "." . $ext;

$targetFile = $folderAddressNew .'/'. $newName;

// Move image
if (move_uploaded_file($fileTmp, $targetFile)) {
    $sql = "INSERT INTO `$tableName` (ID, name, data,type, uploadedBy,message, date) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisss", $postID, $name,$newName,$type,$id,$message,$Date);
    $stmt->execute();
    $stmt = $conn->prepare("INSERT INTO posts (ID, type, uploadedBy, date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sisi", $postID,$type,$id,$Date);
    $stmt->execute();
    $stmt = $conn->prepare("UPDATE user SET sharedLinks = sharedLinks + 1 WHERE ID = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();


} else {
    echo "End";
}
}





if($type == '4'){
    include "../phpqrcode/qrlib.php";
$text = 'https://instagram.com/'.$data ?? "";

    if ($text == "") {
        die("No text provided");
    }


    // Folder to save QR images
    $folder = "../assets/qrImg/";

    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }

    // Unique file name
    $fileName = $folder . "qr_" . $postID . ".jpg";

    // Generate QR code (temporary PNG)
    $tempPng = $folder . "temp.png";

    QRcode::png($text, $tempPng, QR_ECLEVEL_L, 10);

    // Convert PNG to JPG
    $image = imagecreatefrompng($tempPng);
    imagejpeg($image, $fileName, 100);

    // Cleanup
    imagedestroy($image);
    unlink($tempPng);
}
}

$stmt->close();
$conn->close();
?>