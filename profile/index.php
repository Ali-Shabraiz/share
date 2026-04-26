<?php 
if (isset($_COOKIE['userID'])) {
    $logoutBtn = '<button class="logOutBtn fa fa-sign-out" onclick="accountlogOut(`../`)"></button>';
}
else{
    $mainBtnFunction = "showSignUpLogInForm('../')";

}

function followText($isFollowed, $isFollowing) {
    if ($isFollowed && $isFollowing)
        return "Unfriend";
    else if ($isFollowed == 0 && $isFollowing == 1)
        return "Unfollow";
    else if ($isFollowing == 0 && $isFollowed == 1)
        return "Follow Back";
    else
        return "Follow";
}

function followAddress($isFollowed, $isFollowing) {
    return $isFollowing ? "un" : "";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/CSS/style.css">
    <script src="../follow.js"></script>
    <script async src="https://www.tiktok.com/embed.js"></script>
    <link rel="stylesheet" href="../assets/CSS/globalVariables.css">
    <style>
      
       
    
        .content .info{
        flex-direction: row;
        flex-wrap: wrap;
       }
      

     .mobileCover{
            border: 5px solid black;
            width: 275px;
            aspect-ratio: 1 / 1.8;
            max-height: calc(275 * 1.8px);
            border-radius: 20px;
            position: sticky;
            top: calc(var(--navHeight) + 25px);
            background: var(--wte);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding-bottom: 10px;
            align-items: center;
            /* padding: 10px; */
        }
        .mobileCover section{
            width: 100%;
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-content: flex-start;
            gap: 10px;
            justify-content: center;
        }
        .mobileCover .mobileBtn{
            position: absolute;
            top: 20%;
            right: -8px;
            width: 5px;
            background-color: black;
        }
        .mobileCover .mobileBtn.powerBtn{
            height: 30px;
            top: 35%;
        }
        .mobileCover .mobileBtn.volumeBtn{
            height: 60px;
            top: 20%;
        }
        .mobileCover .topBar{
            display: flex;
            height: 20px;
            padding: 3px 8px;
            align-items: center;
            /* background-color: red; */
            justify-content: space-between;
            width: 100%;
            position: relative;
        }
      
        .mobileCover .topBar img{
            height: 100%;
            position: absolute;
            padding: 2px;
            left: 50%;
            transform: translateX(-50%);
        }
        .mobileCover .topBar span{
            font-size: 0.8em; 
            gap: 2px;
            display: flex;
        }
        .mobileCover .personalInfo{
            width: 100%;
            position: relative;
            height: auto;
            padding: 0 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .mobileCover .personalInfo .cover{
            width: 100%;
            background-image: var(--bg);
            min-height: 125px;
            margin-top: 10px;
            background-size: cover;
            background-position: center;
            height: auto;
            margin-top: -5px;
            border-radius: 30px;
        }
        .mobileCover .personalInfo .cover .fa-edit{
            color: var(--wte);
            position: absolute;
            right: 20px;
            top: 15px;
        }
        .mobileCover .personalInfo img.userImg{
            height: auto;
            width: 75px;
            outline: 6px solid var(--wte);
            border-radius: 50%;
            margin-top: -50px;
        }
        .mobileCover .personalInfo p{
            text-align: justify;
            font-size: 0.7em;
        }
        .mobileCover .buttons{
            display: flex;
            gap: 5px;
            margin: 5px;
        }
        .mobileCover .buttons button{
            padding: 5px 10px;
            border-radius: 10px;
            border: none;
            color: var(--wte);
            background: var(--primeryBlue);
        }
        .mobileCover .buttons button.like{
            /* text-align: center; */
            padding: 0;
            width: 30px;
            border: 2px solid var(--heartRed);
            background: var(--lightRed);
            color: var(--heartRed);
        }
        .mobileCover .buttons button.like.active{
            background: var(--heartRed);
            color: var(--lightRed);
        }
        .mobileCover .scoresInfo{
            width: 100%;
            height: auto;
            display: flex;
            justify-content: space-between;
            row-gap: 10px;
            flex-wrap: wrap;
            padding: 0 10px;
            list-style-type: none;
        }
        .mobileCover .scoresInfo li{
            width: 75px;
            height: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
        }
        /* .mobileCover .scoresInfo li *{
            border: 1px solid var(--blk)
        } */
        .mobileCover .scoresInfo li span{
            font-size: 0.7em;
        }
        .mobileCover .email{
            width: calc(100% - 20px);
            display: flex;
            /* padding: 0 10px; */
            justify-content: space-between;
            gap: 5px;
            background: var(--secondWte);
            border-radius: 30px;
        }
        .mobileCover .email input:focus{
            outline: none;
        }
        .mobileCover .email input{
            width: 100%;
            background: transparent;
        }
        .mobileCover .email input,
        .mobileCover .email button{
            padding: 8px 10px;
            border-radius: 30px;
            border: none;
        }
        .mobileCover .email button{
            background: var(--primeryBlue);
            color: var(--wte)
        }
        .mobileCover .socialContainer{
            width: 100%;
            padding: 10px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .mobileCover .socialContainer span{
            background: var(--clr);
            color: var(--wte);
            width: 25px;
            height: 25px;
            align-content: center;
            text-align: center;
            border-radius: 5px;
        }
        .singleProfilePosts{
            display: flex;
            flex-direction: column;
            flex: 1;
            padding: 20px;
            gap: 10px;
        }
        .singleProfilePosts .menuBar{
            background: var(--wte);
            border-radius: 20px;
            width: 100%;
            padding: 5px 5px;
            height: 50px;
            align-items: center;
            position: relative;
            display: flex;
            gap: 10px;
            overflow: hidden;
            position: sticky;
            top: calc(var(--navHeight) + 25px);
            z-index: 11;
            box-shadow: 0 0 1px var(--blk);
        }
        .singleProfilePosts .menuBar li{
            /* padding: 0 10px; */
            height: 100%;
            position: relative;
            align-content: center;
            text-align: center;
            border-radius: 20px;

            
        }
        .singleProfilePosts .menuBar li label{
            border-radius: 20px;
            padding: 10px;
            
        }
        .singleProfilePosts .menuBar li:hover{
            background: var(--secondWte);
        }
        .singleProfilePostContainer{
            display: none;
            flex-wrap: wrap;
            padding: 0 20px;
            gap: 2px;
            justify-content: baseline;
            
        }
        .singleProfilePostContainer .reel,
        .singleProfilePostContainer .img{
            width: 125px;
            position: relative;
            aspect-ratio: 1 / 1.5;
            background-image: var(--bg);
            background-position: center;
            background-size: cover;
            /* background: red; */
        }
        .singleProfilePostContainer .reel{
            object-fit: cover;
            align-items: center;
            display: flex;
        }
        
        .singleProfilePostContainer .reel video{
            /* display: none; */
            width: 100%;
            object-fit:cover;
            height: 100%;
        }
        input[type="radio"]:checked + .singleProfilePostContainer{
            display: flex !important;
        }

        .WAcard{
            width: 100%;
            background: var(--wte);
            padding: 10px 8px 8px 8px;
            color: #25D366;
            display: flex;
            flex-direction: column;
            gap: 10px;
            border-radius: 15px;
            box-shadow: 0 0 5px #25D366;
            margin-top: 10px;
        }
        .TTCard{
            width: 100%;
            
        }
        .WAcard form{
            display: flex;
            width: 100%;
            gap: 5px;
            justify-content: space-between;

        }
        .WAcard form input{
            width: 100%;
        }
        .WAcard form input,
        .WAcard form button{
            padding: 10px 15px;
            /* border: none; */
            border: 2px solid #25D366;
            border-radius: 10px;
        }
        .WAcard form button{
            background : #25D366;
            color: var(--wte);
            
            font-weight: 600;
        }
        .instaPosts{
            display: flex;
            width: 100%;
            justify-content: space-between;
        }
        .instaPosts button{
            background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
            border-radius: 10px;
            border: none;
            color: var(--wte);
        }
        
        

       
      
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sharing is caring</title>
</head>

<body>
    <div class="main">
    <?php include "../assets/components/nav.php";
    $tableName = 'follow_'.$_COOKIE['userID'];
    $sql = "SELECT follower,following FROM `$tableName` WHERE fID = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $MyData['ID']);
    $stmt->execute();
    $result1 = $stmt->get_result();
    $row1 = $result1->fetch_assoc();
    if($result1->num_rows){
    $MyData['isFollowed'] = $row1['follower'];
    $MyData['isFollowing'] = $row1['following'];
    if($MyData['isFollowed'] && $MyData['isFollowing'])
        $MyData['isfriend'] = 1;
    else
        $MyData['isFriend'] = 0;
    } else {
        $MyData['isFollowed'] = 0;
        $MyData['isFollowing'] = 0;
        $MyData['isFriend'] = 0;
        }
        $likeTableName = 'like_'.$_COOKIE['userID'];
    $sql = "SELECT isMe FROM `$likeTableName` WHERE liked = ? AND type = 0 AND isMe = 1 LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $MyData['ID']);
    $stmt->execute();
    $result1 = $stmt->get_result();
    $row1 = $result1->fetch_assoc();
    if($result1->num_rows)
    $MyData['likedByMe'] = $row1['isMe'];
else
    $MyData['likedByMe'] = 0;
    ?>
    
    <div class="content">
        <?php include "../assets/components/aside.php";?>
        <?php if($isIdFound){?>
        <div class="info">
            <h2 style="width: 100%">Profile</h2>
            <div class="mobileCover">
        <span class="mobileBtn powerBtn"></span>
        <span class="mobileBtn volumeBtn"></span>
        <section>
        <div class="topBar">
            <span id="time"></span>
            <img src="../lens.png" alt="" >
            <span><span class="fa fa-battery" id="batteryIcon"></span><span id="battery"></span></span>
        </div>
        <div class="personalInfo">
            <div style="--bg: url('../assets/image/<?php echo $MyData['img'];?>')"  class="cover">
                <?php if($isMyProfile){?>
                <label for="personalInfoCheck" class="fa fa-edit editBtn"></label>
               <?php } ?>
            </div>
            <img src="../assets/image/<?php echo $MyData['img'];?>" alt="" class="userImg">
            <h3><?php echo $MyData['name']?></h3>
            <span class="grayText"><?php echo $MyData['nickName']?></span>
            <p><?php echo $MyData['bio']?></p>
            <div class="buttons">
                <form data-address="<?php echo followAddress($MyData['isFollowed'],$MyData['isFollowing']);?>" id="followForm_<?php echo $MyData['ID']?>" onsubmit="followHim('../','<?php echo $MyData['ID']?>',this.dataset.address,'profilesAfterFollow')">
                <button type="submit"  id="followBtn<?php echo $MyData['ID'];?>"><?php echo followText($MyData['isFollowed'],$MyData['isFollowing'])?></button>
                </form>
                <button>Share <i class="fa fa-share"></i></button>
                <button  id="likeBtn<?php echo $MyData['ID'];?>" onclick="likeIt('<?php echo $MyData['ID'];?>')" class="<?php echo ($MyData['likedByMe']) ? 'fa active' : 'far';?> fa-heart like"></button>
            </div>            
        </div>
        <ul class="scoresInfo">
                <li><h6>Followers</h6><span id="followersNumber<?php echo $MyData['ID']?>"><?php echo $MyData['follower']?></span></li>
                <li><h6>Following</h6><span id="followingNumber<?php echo $MyData['ID']?>"><?php echo $MyData['following']?></span></li>
                <li><h6>Friends</h6><span id="friendNumber<?php echo $MyData['ID']?>"><?php echo $MyData['friends']?></span></li>
                <li><h6>Posts</h6><span><?php echo $MyData['sharedLinks']?></span></li>
                <li><h6>Likes</h6><span id="likeNumber<?php echo $MyData['ID']?>"><?php echo $MyData['likes']?></span></li>
                <li><h6>Scores</h6><span id="scoresNumber<?php echo $MyData['ID']?>"><?php echo $MyData['follower']*5 + $MyData['following']*2+$MyData['likes']*8+$MyData['friends']*10+$MyData['sharedLinks']*15;?></span></li>
        </ul>
        <div class="socialContainer">
            <?php if($MyData['whatsapp'] != NULL){?>
                <span onclick="window.open('https://wa.me/<?php echo $MyData['whatsapp'];?>','_parent')"  class="fab fa-whatsapp" style="--clr: #25D366"></span>
                <?php }?>
                <?php if($MyData['facebook'] != NULL){?>
                <span onclick="window.open('<?php echo $MyData['facebook'];?>','_parent')"  class="fab fa-facebook-f" style="--clr: #4267B2"></span>
                <?php }?>
                <?php if($MyData['youtube'] != null){?>
                <span onclick="window.open('<?php echo $MyData['whatsapp'];?>','_parent')"  class="fab fa-youtube" style="--clr: #ff0000"></span>
                <?php }?>
                <?php if($MyData['tiktok'] != null){?>
                <span onclick="window.open('https://tiktok.com/@<?php echo $MyData['tiktok'];?>','_parent')"  class="fab fa-tiktok" style="--clr: #000000"></span>
                <?php }?>
                <?php if($MyData['instagram'] != null){?>
                <span onclick="window.open('https://instagram.com/<?php echo $MyData['whatsapp'];?>','_parent')"  class="fab fa-instagram" style="--clr: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%)"></span>
                <?php }?>
                <?php if($isMyProfile){?>
            <label style="position: absolute;right:10px;" for="socialAccountCheck" class="fa fa-edit editBtn"></label>
            <?php }?>
        </div>
    </section>

            <?php if($isMyProfile){?>
                <button class="dangerButton" style="width: calc(100% - 20px);" value="<?php echo $MyData['ID']?>">Delete Account</button>
            <?php } else {?>
            <form class="email">
                <input type="text" placeholder="Enter Email">
                <button>Send</button>
            </form>

            <?php }?>
    </div>
    <div class="singleProfilePosts">
        <ul class="menuBar">
            <li onclick="activeMenu(this);" class="active"><label for="imagesPostCheck"><span class="fa fa-image"></span> Images</label></li>
            <li onclick="activeMenu(this);"><label for="videoPostCheck"><span class="fa fa-file-video"></span> Reels</label></li>
            <li onclick="activeMenu(this);"><label for="WAPostCheck"><span class="fab fa-whatsapp"></span> WhatsApp</label></li>
            <li onclick="activeMenu(this);"><label for="TTPostCheck"><span class="fab fa-tiktok"></span> TikTok</label></li>
            <li onclick="activeMenu(this);"><label for="instaPostCheck"><span class="fab fa-instagram"></span> Instagram</label></li>
            <li onclick="activeMenu(this);"><label for="FBPostCheck"><span class="fab fa-facebook"></span> FaceBook</label></li>
        </ul>
        <input type="radio" name="singleProfilePostContainer" class="displayNone" id="imagesPostCheck" checked>
        <div class="imagesPosts singleProfilePostContainer"></div>
        <input type="radio" name="singleProfilePostContainer" class="displayNone" id="videoPostCheck">
        <div class="videosPosts singleProfilePostContainer"></div>
        <input type="radio" name="singleProfilePostContainer" class="displayNone" id="WAPostCheck">
        <div class="whatsAppPosts singleProfilePostContainer"></div>
        <input type="radio" name="singleProfilePostContainer" class="displayNone" id="TTPostCheck">
        <div class="TTPosts singleProfilePostContainer"></div>
        <input type="radio" name="singleProfilePostContainer" class="displayNone" id="instaPostCheck">
        <div class="InstaPosts singleProfilePostContainer"></div>
        <input type="radio" name="singleProfilePostContainer" class="displayNone" id="FBPostCheck">
        <div class="FBPosts singleProfilePostContainer"></div>
        
    </div>
    <script>
        function activeMenu(element){
            document.querySelectorAll('.singleProfilePosts .menuBar li').forEach(li => {
                li.classList.remove('active');
            })
            element.classList.add('active');
        }
    </script>
            <?php if($isMyProfile){?>
                <input type="checkbox" id="personalInfoCheck" class="displayNone">
                <form onsubmit="updateProductbasic()" id="personalInfoForm" class="logIn">
                    <label for="personalInfoCheck" class="fa fa-times crossIcon"></label>
                    <h2>Personal Inforamation</h2>
                    <label for="image" class="fa-regular fa-camera logo"></label>
                    <input type="file" class="displayNone" id="image" accept="image/*" name="image">
                    <input type="hidden" name="ID" value="<?php echo $MyData['ID'];?>">
                    <fieldset>
                        <input type="text"  placeholder="<?php echo $MyData['name']?>" name="name" value="<?php echo $MyData['name']?>">
                    </fieldset>
                    <fieldset>
                        <input type="email"  placeholder="<?php echo $MyData['email']?>" name="email" value="<?php echo $MyData['email']?>">
                    </fieldset>
                    <button>Update</button>
                </form>
                <?php }?>
            
            <?php if($isMyProfile){?>
                <input type="checkbox" id="basicInfoCheck" class="displayNone">
                <form  class="logIn" onsubmit="updateBasicInfo('basicInfoForm')" id="basicInfoForm">
                    <h2>Basic Information</h2>
                    <input type="hidden" name="ID" value="<?php echo $MyData['ID']?>">
                    <fieldset>
                        <input type="text" name="nickName" placeholder="Nick Name" value="<?Php echo $MyData['nickName']?>">
                    </fieldset>
                    <fieldset>
                        <input type="text" name="bio" placeholder="Enter Bio" value="<?Php echo $MyData['bio']?>">
                    </fieldset>
                    <button>Update</button>
                </form>
                <?php }?>
                
            <?php if($isMyProfile){?>

                <input type="checkbox" id="socialAccountCheck" class="displayNone">
            <form class="logIn" onsubmit="updateSocialAccounts('updateSocialAccounts')" id="updateSocialAccounts">
                    <label for="socialAccountCheck" class="fa fa-times crossIcon"></label>
                    <h2>Social Account Information</h2>
                <input type="hidden" name="ID" value="<?Php echo $MyData['ID'];?>">
                <fieldset>
                    <h4>WhatsApp Number</h4>
                    <input type="text" name="whatsapp" placeholder="e.g:- +92 3** *******" value="<?Php echo $MyData['whatsapp']?>">
                </fieldset>
                <fieldset>
                    <h4>TikTok ID Name</h4>
                    <input type="text" name="tiktok" placeholder="e.g:- mr.webdeveloper" value="<?Php echo $MyData['tiktok']?>">
                </fieldset>
                <fieldset>
                    <h4>FaceBook Profile Link</h4>
                    <input type="text" name="facebook" placeholder="Enter Facebook Profile Link" value="<?Php echo $MyData['facebook']?>">
                </fieldset>
                <fieldset>
                    <h4>Instagram Profile Link</h4>
                    <input type="text" name="instagram" placeholder="Enter Instagram Profile Link" value="<?Php echo $MyData['instagram']?>">
                </fieldset>
                <fieldset>
                    <h4>YouTube Profile Link</h4>
                    <input type="text" name="youtube" placeholder="Enter YouTube Channel Link" value="<?Php echo $MyData['youtube']?>">
                </fieldset>
                <button>Save</button>
            </form>
            <?php }?>
            
            
            </div>

        </div>
        <?php } else {  ?> 
           <div class="info" style="align-items: center;justify-content: center;">
             <form class="logIn" style="display: flex;width:90%;position: relative;top:0;">
                <div class="logo fa fa-shirt"></div>
        <h2>Create an Account</h2>
        <span class="text">Sign in to access your exclusive styles.</span>
        <fieldset>
            <label for="name">Name</label>
            <input id="name" type="text" name="name" placeholder="Mr. Ali Shabraiz">
        </fieldset>
        <fieldset>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" placeholder="example@gmail.com">
        </fieldset>
        <fieldset>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter new Password">
        </fieldset>
        <fieldset>
            <label for="conformPassword">Password</label>
            <input type="password" id="conformPassword" name="conformPassword" placeholder="Conform new Password">
        </fieldset>
        <button type="submit" value="1">Create Account</button>
            </form>
           </div>
            <?php }?>
        
    </div>
    </div>    
    <form class="logIn" id="signUpLogInForm" onsubmit="logInSignUpFormAJAX(rootofSignLogForm)"></form>
    <script>
       
         function updateProductbasic(){
            let form = document.getElementById(`personalInfoForm`);
            let formData = new FormData(form);    // includes name + slug + file
            console.log(formData)

            $.ajax({
                url: "../PHP/updateProfilePersonal.php",
                type: "POST",
                data: formData,
                processData: false,   // don't convert FormData to string
                contentType: false,   // let browser set multipart/form-data
                success: function (data) {
                    console.log(data);
                    // fetch_all_products();

                },
                error: function (err) {
                    console.log(err);
                    $("#result").html("Request failed");
                }
            });
        }
        function updateBasicInfo(id){
            $.ajax({
                url: "../PHP/updateProfileBasic.php",
                 type: 'POST',
                data: $(`#${id}`).serialize(),
                success: (data => {
                    console.log(data);
            })
            })
        }
        function updateSocialAccounts(id){
            $.ajax({
                url: "../PHP/updateSocialAccounts.php",
                 type: 'POST',
                data: $(`#${id}`).serialize(),
                success: (data => {
                    console.log(data);
            })
            })
        }
   
        const isLogIn = <?php echo $isLogIn;?>;
       
        <?php echo $JSUserIDStatement;?>
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../formDeactivator.js"></script>
    <script src="../nav.js"></script>
     <script>
         function likeIt(postID){
            $.ajax({
                url: '../PHP/likePost.php?profile=1',
                method: 'POST',
                data: {postID: postID},
                success: (data => {
                    document.getElementById(`likeBtn${postID}`).classList.toggle('active');
                    if(data.condition)
                    document.getElementById(`likeBtn${postID}`).classList.replace('far','fa');
                    else
                    document.getElementById(`likeBtn${postID}`).classList.replace('fa','far');

                    document.getElementById(`likeNumber${postID}`).textContent = data.likes;
                    document.getElementById(`scoresNumber${postID}`).textContent = Number(document.getElementById(`scoresNumber${postID}`).innerText) + data.scores;
                })
            })
        }
 function fetch_user_posts(){
            $.ajax({
                url: '../API/fetch_all_myPosts.php',
                method: 'POST',
                data: {userID: '<?Php echo $MyData['ID']?>'},
                success: (data => {
                    displayImages(data.filter(data => data.type == 5));
                    displayVideos(data.filter(data => data.type == 6));
                    displayWA(data.filter(data => data.type == 1));
                    displayTT(data.filter(data => data.type == 3));
                    displayInsta(data.filter(data => data.type == 4));
                })
            })
        }
        fetch_user_posts();
        function displayImages(data){
            var imgContainer = document.querySelector('.imagesPosts');
            data.forEach(d => {
                var img = document.createElement('div');
                img.onclick = () => window.open(`../?sharedPost=${d.ID}`);
                img.classList.add('img');
                img.style.setProperty('--bg',`url('../assets/image/${d.data}')`);
                imgContainer.append(img);
            })
        }
        function displayVideos(data){
            var reelContainer = document.querySelector('.videosPosts');
            data.forEach(d => {
                var reel = document.createElement('div');
                reel.classList.add('reel');
                reel.innerHTML = `<video onclick="window.open('../reels/?sharedPost=${d.ID}')" onmouseover="this.play()" onmouseleave="this.pause()" src="../assets/video/${d.data}" muted loop>`;
                reelContainer.append(reel);
            })
        }
        function displayWA(data){
            var reelContainer = document.querySelector('.whatsAppPosts');
            data.forEach(d => {
                var card = document.createElement('div');
                console.log(d)
                card.classList.add('WAcard');
                card.innerHTML = `<h3><span class="fab fa-whatsapp"></span> Chat with ${d.name}</h3>
                <form onsubmit="sendWAMessage('${d.data}','${d.ID}')" id="WAFrom${d.ID}">
                     <input type="text" placeholder="Enter a Message"><button type="submit">Message</button>
                </form>`;

                reelContainer.append(card);
            })
        }
        function displayTT(data){
            var reelContainer = document.querySelector('.TTPosts');
            data.forEach(d => {
                    var card = document.createElement('div');
                    card.classList.add('TTCard');
                    card.innerHTML = `
                        <blockquote class="tiktok-embed" cite="https://tiktok.com/@${d.data}" data-unique-id="${d.data}" data-embed-type="creator"> <section> <a target="_blank" href="https://www.tiktok.com/@${d.data}?refer=creator_embed">${d.name}</a> </section> </blockquote>
                    `
                reelContainer.append(card);

            })
        }

        function displayInsta(data){
            var reelContainer = document.querySelector('.instaPosts');
            data.forEach(d => {
                    var card = document.createElement('div');
                    card.classList.add('instaCard');
                    card.innerHTML = `
                    <h4>${d.name}</h4><buttton>View Profile</button>
                    `
                reelContainer.append(card);

            })
        }

        function sendWAMessage(number,id){
            let message = document.querySelector(`#WAFrom${id} input`).value;
            window.open(`https://wa.me/${number}?text=${encodeURIComponent(message)}`);
        }
        
       

navigator.getBattery().then(function(battery) {
    function updateBattery() {
        document.getElementById("battery").innerText =
              Math.floor((battery.level * 100)) + "%";
              if(battery.charging)
                document.getElementById('batteryIcon').classList.replace('fa-battery','fa-bolt')
                else 
                document.getElementById('batteryIcon').classList.replace('fa-bolt','fa-battery')

    }

    updateBattery();

    battery.addEventListener("levelchange", updateBattery);
});

function updateTime() {
    const now = new Date();
    let hours = now.getHours().toString().padStart(2, '0');
    let minutes = now.getMinutes().toString().padStart(2, '0');

    document.getElementById("time").innerText = `${hours}:${minutes}`;
}

updateTime();
setInterval(updateTime, 1000*30);
</script>
</body>
</html>