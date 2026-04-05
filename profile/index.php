<?php 
if (isset($_COOKIE['userID'])) {
    $logoutBtn = '<button class="logOutBtn fa fa-sign-out" onclick="accountlogOut(`../`)"></button>';
}
else{
    $mainBtnFunction = "showSignUpLogInForm('../')";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/CSS/style.css">
    <link rel="stylesheet" href="../assets/CSS/globalVariables.css">
    <style>
      
       
    
    .container.socialMediaContainer{
        flex-direction: row;
        gap: 15px;
    }
    .container.socialMediaContainer span{
        width: 40px;
        height: 40px;
        background : var(--clr);
        align-content: center;
        text-align: center;
        font-size: 1.5em;
        color: var(--wte);
        border-radius: 10px;
    }
      
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sharing is caring</title>
</head>

<body>
    <div class="main">
    <?php include "../assets/components/nav.php";?>
    <div class="content">
        <?php include "../assets/components/aside.php";?>
        <?php if($isIdFound){?>
        <div class="info">
            <h2>My Profile</h2>
            <div class="personalInfo container">
                <img src="../assets/image/<?php echo $MyData['img'];?>">
                <h3><?php echo $MyData['name']?></h3>
                <a href="mailto:<?php echo $MyData['email'];?>" class="grayText"><?php echo $MyData['email'];?></a>
            <?php if($isMyProfile){?>
                <label for="personalInfoCheck" class="fa fa-edit editBtn"></label>
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
            </div>
            <h2>Score</h2>
            <div class="container score">
                <div class="column">
                    <h4>Followers</h4>
                    <span><?php echo $MyData['follower']?></span>
                </div>
                <div class="column">
                    <h4>Link Shared</h4>
                    <span><?php echo $MyData['sharedLinks']?></span>
                </div>
                <div class="column">
                    <h4>Likes</h4>
                    <span><?php echo $MyData['likes']?></span>
                </div>
                <div class="column">
                    <h4>Friends</h4>
                    <span><?php echo $MyData['friends']?></span>
                </div>
                <div class="column">
                    <h4>Following</h4>
                    <span><?php echo $MyData['following']?></span>
                </div>
                 <div class="column">
                    <h4>Score</h4>
                    <span><?php echo $MyData['follower']*5 + $MyData['following']*2+$MyData['likes']*8+$MyData['friends']*10+$MyData['sharedLinks']*15;?></span>
                </div>
            </div>
            <h2>Basic Information</h2>
            <div class="container">
                <h4>Nick Name:- <span class="grayText"><?php echo $MyData['nickName']?></span></h4>
                <br>
                <h4>Bio</h4>
                <p class="grayText"><?php echo $MyData['bio']?></p>
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
                <label for="basicInfoCheck" class="fa fa-edit editBtn"></label>
                <?php }?>

            </div>
            <h2>Social Accounts</h2>
            <div class="container socialMediaContainer">
                <span class="fa fa-share" style="--clr: var(--blk)" onclick="window.open('./index.php?id=<?php echo $MyData['ID'];?>','_parent')"></span>
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
            <label for="socialAccountCheck" class="fa fa-edit editBtn"></label>
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
            <?php if($isMyProfile){?>
            <h2>Danger Zone</h2>
            <div class="container">
                <button class="dangerButton" style="width: max-content;" value="<?php echo $MyData['ID']?>">Delete Account</button>

            </div>
            <?php } else {?>
            <h2>Subscribe</h2>
                <div class="container score">
                    <div class="column"><button class="dangerButton">Follow</button></div>
                    <div class="column"><button class="dangerButton">LIke</button></div>
                </div>

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
            let formData = new FormData(form);   // includes name + slug + file
            console.log(formData)

            $.ajax({
                url: "./PHP/updateProfilePersonal.php",
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
                url: "./PHP/updateProfileBasic.php",
                 type: 'POST',
                data: $(`#${id}`).serialize(),
                success: (data => {
                    console.log(data);
            })
            })
        }
        function updateSocialAccounts(id){
            $.ajax({
                url: "./PHP/updateSocialAccounts.php",
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
    <script src="./formDeactivator.js"></script>
    <script src="./nav.js"></script>
</body>
</html>