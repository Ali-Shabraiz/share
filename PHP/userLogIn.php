<?php
include "./config.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$email = $_POST['email'];
$password = $_POST['password'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("SELECT ID,password FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){
    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])){
        $userID = $row['ID'];
        echo $userID;
        setcookie("userID", $userID, time() + 7*24*60*60, "/", "", true, true);
        }
}
else echo 'NO';
}
else echo 'NO';



$stmt->close();
$conn->close();

?>