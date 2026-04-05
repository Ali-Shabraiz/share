<?php
include "./config.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_COOKIE['userID'])){

$id = $_COOKIE['userID'];
$name = $_POST['name'];
$data = $_POST['data'];
$type = $_POST['type'];
$tableName = 'post_'.$id;
$postID = $_POST['postID'];

$sql = "UPDATE `$tableName` SET name = ?, data = ?, type = ? WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssis", $name,$data,$type,$postID);
$stmt->execute();

if($type == '4'){
    include "../phpqrcode/qrlib.php";
    $text = 'https://instagram.com/'.$data;

    if ($text == "") {
        die("No text provided");
    }


    // Folder to save QR images
    $folder = "../assets/qrImg/";
    $file = $folder.'qr_' . $postID . '.jpg';

if (file_exists($file)) {
    unlink($file);
    echo "Image deleted successfully.";
} else {
    echo "File does not exist.";
}

    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }

    // Unique file name
    $fileName = $folder . "qr_" . $postID . "2.jpg";

    // Generate QR code (temporary PNG)
    $tempPng = $folder . "temp.png";

    QRcode::png($text, $tempPng, QR_ECLEVEL_L, 10);

    // Convert PNG to JPG
    $image = imagecreatefrompng($tempPng);
    imagejpeg($image, $fileName, 100);

    // Cleanup
    imagedestroy($image);
    unlink($tempPng);
if (file_exists($fileName)) {
    rename($fileName,$file);
}
}
}

$stmt->close();
$conn->close();
?>