<?php
$likedPage = 1;
if (isset($_COOKIE['userID'])) {
    $logoutBtn = '<button class="logOutBtn fa fa-sign-out" onclick="accountlogOut(`../`)"></button>';
}
else{
    $mainBtnFunction = "showSignUpLogInForm('../')";
}
$folderLoc = '../';
include "../index.php";
?>