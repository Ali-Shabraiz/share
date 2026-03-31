<?php

$conn = new mysqli("localhost", "root", "", "sharer");
// $conn = new mysqli("localhost", "u694959030_rashi", ":qTPJKYrmV8", "u694959030_rashi");
date_default_timezone_set('Asia/Karachi');
$Date = date("YmdHis");
$rootFolder = $_SERVER['DOCUMENT_ROOT'].'share/';
$currentFolder = __DIR__;
function relativePath($from, $to) {
    // Normalize slashes
    $from = str_replace('\\', '/', realpath($from));
    $to   = str_replace('\\', '/', realpath($to));

    $fromArr = explode('/', rtrim($from, '/'));
    $toArr   = explode('/', rtrim($to, '/'));

    // Find common path
    while(count($fromArr) && count($toArr) && ($fromArr[0] === $toArr[0])) {
        array_shift($fromArr);
        array_shift($toArr);
    }

    // Go up for remaining $from
    $up = str_repeat('../', count($fromArr));

    // Go down into $to
    $down = implode('/', $toArr);

    return $up . ($down ? $down . '/' : '');
}
// include "../../PHP/config.php";
if(isset($_GET['id'])){
        $isMyProfile = 0;
        $isIdFound = 1;
    }
    else {
        $isMyProfile = 0;
        $isIdFound = 0;
    }
if (isset($_COOKIE['userID'])) {
    $userID = $_COOKIE['userID'];
    $mainBtnText = '';
    $mainBtnCLass = 'fa fa-user';
    $mainBtnFunction = "openMyAccount('".$userID."');";
    $isLogIn = 1;
    $JSUserIDStatement = "const userID = '$userID';";
    $stmt = $conn->prepare("SELECT ID,name,email,bio,follower,following,friends,likes,sharedLinks,nickName,img,whatsapp,tiktok,facebook,instagram,youtube FROM user WHERE ID = ? LIMIT 1");
    $stmt->bind_param("s", $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $MyData = $row;
    $isIdFound = 1;
    $isMyProfile = 0;
    if(isset($_GET['id'])){
        if($_GET['id'] == $userID){
            $isMyProfile = 1;
           
        }
        else {
            $isMyProfile = 0;
             $stmt = $conn->prepare("SELECT ID,name,email,bio,follower,following,friends,likes,sharedLinks,nickName,img,whatsapp,tiktok,facebook,instagram,youtube FROM user WHERE ID = ? LIMIT 1");
            $stmt->bind_param("s", $_GET['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $MyData = $row;
            }
    }
    else
        $isMyProfile = 1;
    
} 


else{
    $mainBtnText = "Sign up";
    $logoutBtn = '';
    $mainBtnCLass = '';
    $isLogIn = 0;
    $JSUserIDStatement = '';
    $MyData = [];
    if(isset($_GET['id'])){
        $isMyProfile = 0;
             $stmt = $conn->prepare("SELECT ID,name,email,bio,follower,following,friends,likes,sharedLinks,nickName,img,whatsapp,tiktok,facebook,instagram,youtube FROM user WHERE ID = ? LIMIT 1");
            $stmt->bind_param("s", $_GET['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $MyData = $row;
    }
}
?>
<nav>
        <div class="logo">
            <span class="menuIcon fa fa-bars" style="--bgClr: var(--skyBlue);--clr: var(--primeryBlue)"
                onclick="toggleMenu()"></span>
            <span class="icon fa-regular fa-share"></span><span class="name"><span class="title">Share</span> <span
                    class="subTitle">To show Care</span></span>
        </div>
        <ul class="menuBar">
            <li class="active"><span class="fa fa-home icon"></span><span class="text">Home</span><span
                    class="fa fa-arrow-right arrow"></span></li>
            <li onclick="window.open('https://rashi.thedeepedits.com/products/')"><span class="fa fa-shirt icon"></span><span class="text">Products</span><span
                    class="fa fa-arrow-right arrow"></span></li>
           
            <li><span class="fa fa-circle-info icon"></span><span class="text">About</span><span
                    class="fa fa-arrow-right arrow"></span></li>
            <li><span class="fa fa-envelope icon"></span><span class="text">Contact Us</span><span
                    class="fa fa-arrow-right arrow"></span></li>
            <button class="loginBtn" onclick="<?php echo $mainBtnFunction;?>"><?php echo $mainBtnText;?></button>
        </ul>
        
        <div class="controls">
            <span class="fa-regular fa-heart" style="--bgClr: var(--lightRed);--clr: var(--heartRed)"></span>
            <button
                onclick="<?php echo $mainBtnFunction;?>" class="<?php echo $mainBtnCLass;?>"><?php echo $mainBtnText;?></button>
                <?php echo $logoutBtn;?>
        </div>
    </nav>

