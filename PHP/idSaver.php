<?Php
include "config.php";
function generateUserID($length = 15) {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    return substr(str_shuffle($chars), 0, $length);
}
$ID = generateUserID();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$app = $_POST['app'];
$idName = $_POST['idName'];
$stmt = $conn->prepare("INSERT INTO accountid (ID,app, idName, dateOrder) VALUES (?,?,?,?)");

// Bind parameters: "sssss" = all 5 values are strings
$stmt->bind_param("ssss", $ID,$app, $idName, $Date);
if ($stmt->execute()) {
    echo "Record inserted successfully!";
} else {
    echo "Error inserting record: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>