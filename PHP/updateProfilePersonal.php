<?php
include "./config.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$name = $_POST['name'];
$id = $_POST['ID'];
$email = $_POST['email'];
$folderAddressNew = '../assets/image/';
// Folder where images will be stored

$stmt = $conn->prepare("UPDATE user SET name = ?, email = ? WHERE BINARY ID = ?");
    $stmt->bind_param("sss", $name, $email, $id);
    $stmt->execute();
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
if ($_FILES["image"]["size"] > 5 * 1024 * 1024) {
    exit("File too large (max 5MB)");
}

// Generate unique file name
$newName = uniqid("img_", true) . "." . $ext;

$targetFile = $folderAddressNew .'/'. $newName;

// Move image
if (move_uploaded_file($fileTmp, $targetFile)) {
    echo $id;
    $stmt = $conn->prepare("UPDATE user SET name = ?, email = ?, img = ? WHERE BINARY ID = ?");
    $stmt->bind_param("ssss",  $name, $email, $newName,$id);
    $stmt->execute();

} else {
    echo "End";
}
}







$stmt->close();
$conn->close();



?>