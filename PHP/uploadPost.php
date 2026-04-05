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
$id = $_COOKIE['userID'];
$name = $_POST['name'];
$data = $_POST['data'];
$type = $_POST['type'];
$message = $_POST['message'];
$tableName = 'post_'.$id;



$sql = "INSERT INTO `$tableName` (ID, name, data,type, uploadedBy,message, date) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssisss", $postID, $name,$data,$type,$id,$message,$Date);
$stmt->execute();
$stmt = $conn->prepare("INSERT INTO posts (ID, type, uploadedBy, date) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sisi", $postID,$type,$id,$Date);
$stmt->execute();



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