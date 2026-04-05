<?php
include "./config.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_COOKIE['userID'])){
    $id = $_COOKIE['userID'];
    // $postTable = 'post_'.$id;
// Folder where images will be stored
if(isset($_POST['whatsapp'])){
    $whatsApp = $_POST['whatsapp'];
    if($whatsApp != ''){
        $stmt = $conn->prepare("UPDATE user SET whatsapp = ? WHERE BINARY ID = ?");
        $stmt->bind_param("ss", $whatsApp, $id);
        $stmt->execute();
    }
}
if(isset($_POST['tiktok'])){
    $tiktok = $_POST['tiktok'];
    if($tiktok != ''){
        $stmt = $conn->prepare("UPDATE user SET tiktok = ? WHERE BINARY ID = ?");
        $stmt->bind_param("ss", $tiktok, $id);
        $stmt->execute();
    }
}
if(isset($_POST['facebook'])){
    $facebook = $_POST['facebook'];
    if($facebook != ''){
        $stmt = $conn->prepare("UPDATE user SET facebook = ? WHERE BINARY ID = ?");
        $stmt->bind_param("ss", $facebook, $id);
        $stmt->execute();
    }
}
if(isset($_POST['instagram'])){
    $instagram = $_POST['instagram'];
    if($instagram != ''){
        $stmt = $conn->prepare("UPDATE user SET instagram = ? WHERE BINARY ID = ?");
        $stmt->bind_param("ss", $instagram, $id);
        $stmt->execute();
    }
}
if(isset($_POST['youtube'])){
    $youtube = $_POST['youtube'];
    if($youtube != ''){
        $stmt = $conn->prepare("UPDATE user SET youtube = ? WHERE BINARY ID = ?");
        $stmt->bind_param("ss", $youtube, $id);
        $stmt->execute();
    }
}
}


$stmt->close();
$conn->close();

?>