<?php
include "./config.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate 15-character random ID
function generateUserID($length = 15) {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    return substr(str_shuffle($chars), 0, $length);
}

// Data (example – usually from $_POST)
$name  = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$conformPassword = $_POST['conformPassword'];

// Hash password (IMPORTANT)
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Generate ID
$userID = generateUserID();

$stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Prepare SQL
if($result->num_rows == 0){
$stmt = $conn->prepare("INSERT INTO user (ID, name, email, password,cpass,dateOrder) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $userID, $name, $email, $hashedPassword,$conformPassword,$Date);
if ($stmt->execute()) {
    $tableName = 'follow_'.$userID;
    setcookie("userID", $userID, time() + 7*24*60*60, "/", "", true, true);
    echo "user-created";
    $sql = "CREATE TABLE `$tableName` (
  `ID` varchar(20) NOT NULL PRIMARY KEY,
  `fID` varchar(20) NOT NULL,
  `friend` tinyint(1) NOT NULL DEFAULT 0,
  `follower` tinyint(1) NOT NULL,
  `following` tinyint(1) NOT NULL,
  `date` varchar(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
$stmt = $conn->prepare($sql);
$stmt->execute();
} else {
    echo "User-already-exist";
}
}else{
    echo "User-already-exist";
    
}

// Close
$stmt->close();
$conn->close();
?>
