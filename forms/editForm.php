<?php
include "../PHP/config.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_COOKIE['userID'])){
$postId = $_GET['postID'];
$fName = $_GET['FName'];
$id = $_COOKIE['userID'];
$tableName = 'post_'.$id;
$sql = "SELECT * FROM `$tableName` WHERE ID = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $postId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

?>

            <label for="editFormCheck" class="crossIcon fa fa-times"></label>
            <h2>Edit <?php echo $fName;?> Account</h2>
            <input type="hidden" name="type" value="<?php echo $row['type']?>">
            <input type="hidden" name="postID" value="<?php echo $postId?>">
            <fieldset>
                <input type="text" placeholder="<?php echo $row['name']?>" name="name" value="<?php echo $row['name']?>">
            </fieldset>
            <fieldset>
                <input type="text" placeholder="<?php echo $row['data']?>" value="<?php echo $row['data'];?>" name="data">
            </fieldset>
            <fieldset>
                <input type="text" placeholder="Write Something about this post" name="message" value="<?php echo $row['message']?>">
            </fieldset>
            <button>Update</button>


<?php 
$stmt->close();
}
$conn->close();
?>
