<?php 
if(!isset($likedPage)){
    $likedPage = 0;
    if (isset($_COOKIE['userID'])) {
    $logoutBtn = '<button class="logOutBtn fa fa-sign-out" onclick="accountlogOut(`./`)"></button>';
}
else{
    $mainBtnFunction = "showSignUpLogInForm('./')";
}
$folderLoc = './';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo $folderLoc?>assets/CSS/globalVariables.css">
    <link rel="stylesheet" href="<?php echo $folderLoc?>assets/CSS/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/qr-code-styling/lib/qr-code-styling.js"></script>
    <link rel="stylesheet" href="<?php echo $folderLoc?>assets/CSS/globalVariables.css">
    <script async src="https://www.tiktok.com/embed.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?php echo $folderLoc?>follow.js"></script>
    <title>Home - Share</title>
    <style>
      body{
        overflow-x: hidden;
      }
       .content .info{
            flex-direction: row;
            display: flex;
            justify-content: space-between;
            padding: 0;
            gap: 0;
        }
       
       .content .info .accountsAndLinks{
            right: 0;
            min-width: 350px;
            top: var(--navHeight);
            left: auto;
            background: var(--secondWte);
            position: sticky;
        }
       .content .info .accountsAndLinks .friends{
        width: 100%;
        height: 50px;
        background: var(--wte);
        border-radius: 40px;
        display: flex;
        align-items: center;
        padding: 5px 5px 5px 20px;
        position: relative;
        justify-content: space-between;
    }
    .content .info .accountsAndLinks .friends .friendsImg{
        border-radius: 40px;
        height: 100%;
        display: flex;
       }
    .content .info .accountsAndLinks .friends .friendsImg img{
        border-radius: 50%;
        
    }
    .content .info .accountsAndLinks .friends .friendsImg img:not(:last-child){
    margin-right: -10px;
}
       .content .info .accountsAndLinks .profiles{
        display: flex;
        width: 100%;
        position: relative;
        flex-direction: column;
        gap: 5px;
       }
        .accountsAndLinks .profileRow{
            width: 100%;
            height: 50px;
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            position: relative;
            /* column-gap: 5px; */
            justify-content: center;
            align-content: space-between;
            /* background: red; */
        }
        .profileRow .personalData{
            display: flex;
            height: 100%;
            justify-content: center;
            column-gap: 10px;
            flex-direction: column;
            flex-wrap: wrap;
        }
        .accountsAndLinks .profileRow .fa-user-plus,
        .content .info .accountsAndLinks .profiles .profileRow .personalData .fa-heart
        
        {
            display: none;
        }
        .accountsAndLinks .profileRow button,
        .accountsAndLinks .profileRow img{
            height: 45px;
            border-radius: 50%;
            width: 45px;
        }
        .accountsAndLinks .profileRow button{
            width: max-content;
            padding: 3px 5px;
            border-radius: 0;
            border: none;
            background: transparent;
            color: var(--primeryBlue);
        }
        .content .info .posts{
            width: 100%;
            /* background: var(--blk) */
            display: flex;
            justify-content: center;
        }
       .content .info .postContainer{
        /* background: red; */
        width: 450px;
        padding-top: 25px;
        position: relative;
       }

       .content .info .postContainer .singlePost{
        display: flex;
        flex-direction: column;
        gap: 10px;
       }
       .content .info .postContainer .uploadedBy       {
        padding: 10px;
        display: flex;
        justify-content: space-between;
        height: 50px;
        align-items: center;
       }
       .content .info .postContainer .uploadedBy section{
        display: flex;
        position: relative;
        height: 45px;
        align-items: center;
        gap: 5px;
       }
      
       .content .info .postContainer .uploadedBy section img{
        height: 45px;
        border-radius: 50%;
       }

       .content .info .postContainer .uploadedBy section button{
            background: transparent;
            border: none;
            color: var(--primeryBlue);
       }
       .content .info .postContainer .uploadedBy section h6{
        font-size: 0.7em;
       }
       .content .info .postContainer .details{
        padding: 10px;
        display: flex;
        flex-direction: column;
        gap: 5px;
       }
       .content .info .postContainer .details section{
        gap: 5px;
        display: flex;
       }
       .content .info .postContainer .details section p{
        text-align: justify;
       }
       .content .info .postContainer .postData{
        width: 100%;
        height: max-content;

    }
    .content .info .postContainer .postData:has(:not( .WACard)){
           overflow: visible;

       }
       .content .info .postContainer .postData img{
        width: 100%;
        border-radius: 15px;

       }
         .WACard,.FBCard,.TTCard,.insta-card{
            width: 100%;
            height: max-content;
            position: relative;
            display: flex;
            flex-direction: column;
            border-radius: 10px;
            align-items: center;
            padding-bottom: 20px;
            outline: 2px solid var(--clr);
        }
         .FBCard .profilePic,
         .WACard .profilePic{

            /* position: absolute; */
            left: 50%;
            transform: translateY(-50%);
            outline: 5px solid var(--wte);
            background : var(--wte);
            border-radius: 50%;
            margin-bottom: -15px;
        }
         .WACard .profilePic{
            left: 50%;
            transform: translateY(-50%);
            outline: 5px solid var(--wte);
            background : var(--wte);
            border-radius: 50%;
            margin-bottom: -15px;
            width: 50px !important;
         }
         .WACard h3,
         .FBCard h3{
             font-weight: 500;
             font-size: 1.2em; 
         }
         .WACard .qrcode,
         .FBCard .qrcode{
            padding: 20px;
            /* box-shadow: 0 0 15px var(--waClr); */
            border: 2px solid var(--clr);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 10px;
            border-radius: 10px;
            position: relative;
        }
         .WACard .qrcode .number,
        .insta-card .qrcode .number,
         .FBCard .qrcode .number{
            position: absolute;
            bottom: 0;
            font-size: 0.7em;
            background: var(--clr);
            box-shadow: 0 7px 15px var(--clr);
            color: var(--wte);
            border-radius: 20px;
            transform: translateY(50%);
            padding: 5px 8px;
            font-weight: 600;
            text-decoration: none;
         }
         .WACard .qrcode .fab{
             position:absolute;
            z-index:1;
            font-size:1.6em;
            border-radius:50%;
            background:var(--wte);
            width:25px;
            height:25px;
            text-align:center;
            align-content:center;
         }
         .WACard .fa,
         .FBCard .fa,
         .TTCard .fa,
         .insta-card .fa{
            border-bottom-color: var(--clr);
            border-left-color: var(--clr);
            z-index: 11;
         }





         .insta-card {
  position: relative;
  border-radius: 20px;
  padding: 20px;
  /* background: var(--wte); */
  box-shadow:
    0 2px 5px rgba(250, 126, 30, 0.3),
    0 3px 10px rgba(214, 41, 118, 0.3),
    0 5px 15px rgba(150, 47, 191, 0.3);
}
        .insta-card h3{
        background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
        color: transparent;
        background-clip: text;
        margin-bottom: 10px;
       }

.insta-card::before {
  content: "";
  position: absolute;
  inset: 0;
  padding: 3px;
  border-radius: 20px;
  /* background: linear-gradient(45deg,
    #feda75, #fa7e1e, #d62976, #962fbf, #4f5bd5); */

  /* -webkit-mask: 
    linear-gradient(#fff 0 0) content-box, 
    linear-gradient(#fff 0 0);
  -webkit-mask-composite: xor;
          mask-composite: exclude; */
}

.insta-card {
    text-align: center;
    border: none;
}

/* QR container */
.insta-card .qrcode {
    position: relative;
    width: 200px;
    height: 200px;
    display: flex;
    justify-content: center;
    background: var(--bg),radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
    background-size: cover;
    background-blend-mode: screen;
    border: 3px solid;
    border-image: radial-gradient(circle at 30% 107%,
    #fdf497 0%,
    #fdf497 5%,
    #fd5949 45%,
    #d6249f 60%,
    #285AEB 90%
    ) 1;

}

@media (max-width: 1130px){
    :root{
        --asideWidth: 200px;
    }
    aside{
        width: var(--asideWidth);
    }
       .content .info .accountsAndLinks {
        min-width: 300px;
       }
       .content .info .accountsAndLinks h5{
        font-size: 0.7em;
       }
       .content .info .accountsAndLinks h6{
        font-size: 0.6em;
       }
       .content .info .postContainer{
        width: 400px;
       }
}
@media (max-width: 920px){
       .content .info  {
        width: 100%;
       }
    .leftAside{
        display: none;
    }
}
@media (max-width: 715px){
       .content .info  .postContainer{
        width: 300px;
       }

}
@media (max-width: 715px){
    .content .info  .postContainer{
        width: 400px;
       }
       .content .info  {
        flex-direction: column-reverse;
       }
        .content .info .accountsAndLinks .friends,
       .content .info .accountsAndLinks .profiles .profileRow h6,
       .content .info .accountsAndLinks .profiles h4{
        
        
        display: none;
        }
        .content .info .accountsAndLinks{
            height: max-content;
            width: 100%;
            overflow-x: auto;
            position: relative;
            border-top: 2px solid var(--blk);
            top: 0;
        }
       .content .info .accountsAndLinks .profiles{
            flex-direction: row;
            justify-content: flex-start;
            gap: 10px;
        }
        .content .info .accountsAndLinks .profiles .profileRow .personalData,
       .content .info .accountsAndLinks .profiles .profileRow{
            flex-wrap: nowrap
       }
       .content .info .accountsAndLinks .profiles .profileRow{
        position: relative;
        /* background: red; */
        height: 100px;
        gap: 10px;
        justify-content: space-between;
       }
        .content .info .accountsAndLinks .profiles .profileRow .personalData{
 align-content: center;
        text-align: center;
        align-items: center;
        }
        .content .info .accountsAndLinks .profiles .profileRow .personalData .img {
            /* background: yellow; */
            position: relative;
            display: flex;
            justify-content: center;
        
        }
        .content .info .accountsAndLinks .profiles .profileRow .personalData .img img{
            width: 75px;
            height: 75px;
        }
        .content .info .accountsAndLinks .profiles .profileRow .personalData .fa-user-plus,
        .content .info .accountsAndLinks .profiles .profileRow .personalData .fa-heart

        {
            position: absolute;
            display: block;
            bottom: 5px;
            width: 40px;
            height: 20px;
            font-size: 0.9em;
            color: var(--wte);
            background: var(--blk);
            align-content: center;
            text-align: center;
            border-radius: 5px;
        }
       
       .content .info .accountsAndLinks .profiles .profileRow button {
        display: none;
       }
       .content .info .accountsAndLinks .profiles .profileRow h5{
        font-size: 0.6em;
        max-width: 13ch;   /* limits to ~16 characters */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
       }
       

}



        
    </style>
</head>
<body>
    <div class="main">
         <?php include $folderLoc."assets/components/nav.php";?>
         <div class="content">
            <?php include $folderLoc."assets/components/aside.php";?>
            <div class="info">
                <div class="posts">
                    <div class="postContainer" id="postContainer"></div>
                </div>
                <aside class="accountsAndLinks">
                    <div class="profiles" id="profiles"></div>
                    <div class="friends">
                        <h3><span class="fa fa-user-friends"></span> Message</h3>
                        <div class="friendsImg" id="friendsImg"></div>
                    </div>
                </aside>
            </div>
         </div>
    </div>
    <script src="<?php echo $folderLoc?>nav.js"></script>
    <script>
         function shareProfile(text,name) {
  if (navigator.share) {
    navigator.share({
      title: `Share About ${name}`,
      text: `See Information about ${name}`,
      url: `${text}`
    })
    .then(() => console.log('Shared successfully'))
    .catch((error) => console.log('Error:', error));
  } else {
    alert('Linked Copied');
    navigator.clipboard.writeText(text);
  }
}
       function fetch_top_five(){
            fetch('<?php echo $folderLoc?>API/fetch_top_profiles.php<?php echo ($likedPage) ? '?likePage=1':''?>').then(res => {
                return res.json();
            }).then(data => {
                displayTopProfiles(data);
                displayFriendsImg(data);
            })
        }
        fetch_top_five();
        function displayTopProfiles(data){
            let profileContainer =  document.getElementById('profiles');
           profileContainer.innerHTML = ' <h4>Top Users</h4>';
            data.forEach(profile => {
                var row = document.createElement('div');
                row.classList.add('profileRow');
                row.innerHTML = `
                    <div class="personalData">
                            <div class="img">
                            <img src="<?php echo $folderLoc?>assets/image/${profile.img}">
                        <?php if(!$likedPage){?>
                            <span class="fa fa-user-plus"></span>
                        <?php } else {?>
                            <span class="fa fa-heart"></span>

                        <?php }?>
                            </div>
                            <h5>${profile.name}</h5>
                            <h6>${profile.email}</h6>
                        </div>
                        <?php if(!$likedPage){?>
                        <button class="postFollowBtn${profile.ID}" data-address="${followAddress(profile.isFollowed,profile.isFollowing)}" onclick="followHim('<?php echo $folderLoc?>','${profile.ID}',this.dataset.address,'postAfterFollow')">${followText(profile.isFollowed,profile.isFollowing)}</button>
                        <?php } else {?>
                        <button class="${profile.likedByMe ? 'fa': 'far'}  fa-heart" style="font-size:1.2em;color: var(--heartRed)" onclick="likeIt('${profile.ID}')"></button>
                        <?php  }?>

                            
                            
                        `;
                profileContainer.append(row);

            })
        }
        function displayFriendsImg(data){
            let i=0;
            let friendsImg =  document.getElementById('friendsImg');
            for(i=0;i<3;i++){
                let img = document.createElement('img');
                img.src = `<?php echo $folderLoc?>assets/image/${data[i].img}`;
                friendsImg.append(img);
}
        
        }
        function fetch_post(scrolled,firstReq){
            allowToRequestPosts = 0;
            fetch(`<?php echo $folderLoc?>API/fetch_post.php${firstReq}`).then(res => {
                return res.json()
            }).then(data => {
                displayPosts(data,!scrolled);
                allowToRequestPosts = 1;
            })
        }
        fetch_post(0,'?firstReq=1<?Php echo ($likedPage) ? "&likePage=1":"";?>');
        function displayPosts(data,scrolled){
            let postContainer = document.getElementById('postContainer');
            if(scrolled)
                postContainer.innerHTML = ``;
            data.forEach(post => {
                let singlePost = document.createElement('div');
                singlePost.classList.add('singlePost');
                singlePost.innerHTML = `
                            <div class="uploadedBy">
                            <section>
                                <img src="<?php echo $folderLoc?>assets/image/${post.img}" alt="">
                                <h5>${post.name}</h5>
                                <h6 class="grayText">${post.date}</h6>
                            </section>
                            <section>
                                <button class="postFollowBtn${post.uID}" data-address="${followAddress(post.isFollowed,post.isFollowing)}" onclick="followHim('<?php echo $folderLoc?>','${post.uID}',this.dataset.address,'postAfterFollow')">${followText(post.isFollowed,post.isFollowing)}</button>
                                <span class="fa fa-ellipsis"></span>
                            </section>
                        </div>
                        <div class="postData" id="postData${post.postID}"></div>
                        <div class="details">
                            <section>
                                <span onclick="likeIt('${post.ID}')"><i id="likeBtn${post.ID}" class="${post.likebyMe ? 'fa' : 'far'} fa-heart" style="color: var(${(post.likebyMe) ? '--heartRed': '--blk'})"></i><span id="likeCount${post.ID}"> ${post.likes}</span></span>
                                <span><i class="far fa-comment"></i> 0</span>
                            </section>
                            <section>
                                <p>${post.message}</p>
                            </section>
                        </div>
                        
                `;
                postContainer.append(singlePost);
                displaySwitch(post,post.type);
            })
        }
       
        
        function genrateQR(data){
            if(data.type == 1)
                data.data = `https://wa.me/${data.data}`;
            const qrCode = new QRCodeStyling({
    width: 160,
    height: 160,
    data: `${data.data}`,
    dotsOptions: {
        color: "#000",
        type: "square"
    },
    backgroundOptions: {
        color: "transparent"
    }
});

qrCode.append(document.getElementById(`qrcode${data.postID}`));
        }

        function likeIt(postID){
            $.ajax({
                url: '<?php echo $folderLoc?>PHP/likePost.php',
                method: 'POST',
                data: {postID: postID},
                success: (data => {
                    if(data.condition)
                        document.getElementById(`likeBtn${postID}`).classList.replace('far','fa');
                    else
                        document.getElementById(`likeBtn${postID}`).classList.replace('fa','far');
                    document.getElementById(`likeCount${postID}`).textContent = ' '+data.likes;
                    document.getElementById(`likeBtn${postID}`).style.color = `var(${data.color})`;
                })
            })
        }
        
        function displaySwitch(data,type){
            if(type == 1){
                displayWACard(data);
                genrateQR(data);
            } else if(type == 2){
                displayFBCard(data)
                genrateQR(data);
            }  else if(type == 3){
                displayTikTokCard(data);
            } else if(type == 4){
                displayInstaCard(data);
            } else if(type == 5)
                displayImage(data)
        }
        function displayImage(data){
             document.getElementById(`postData${data.postID}`).innerHTML = `
                <img src="<?php echo $folderLoc?>assets/image/${data.data}">
             `
        }
        function displayWACard(data){
            document.getElementById(`postData${data.postID}`).innerHTML = ` <div class="WACard postCard" style="--clr: #25D366"><img  src="<?php echo $folderLoc?>assets/image/noProfile0.png" class="profilePic" width="50">
                    <i onclick="shareProfile('https://wa.me/${data.data}','${data.dataName}')" class="fa fa-share"></i>
                    <h3>${data.dataName}</h3>
                    <div class="qrcode" id="qrcode${data.postID}">
                        <div class="fab fa-whatsapp"></div>
                        <a class="number" href="https://wa.me/${data.data}">
                            Chat with ${data.data}
                        </a>
                    </div>
                    </div>
            `;
        }
        function displayTikTokCard(data){
             document.getElementById(`postData${data.postID}`).innerHTML = ` <div class="TTCard postCard" style="--clr: #000">
                    <i onclick="shareProfile('https://tiktok.com/@${data.data}','${data.dataName}')" class="fa fa-share"></i>
                    <blockquote class="tiktok-embed" cite="https://tiktok.com/@${data.data}" data-unique-id="${data.data}" data-embed-type="creator"> <section> <a target="_blank" href="https://www.tiktok.com/@${data.data}?refer=creator_embed">${data.dataName}</a> </section> </blockquote>
                    </div>
                    `
                   
        }
        function displayFBCard(data){
            document.getElementById(`postData${data.postID}`).innerHTML = ` <div class="FBCard postCard" style="--clr: #1877F2">
                    <i onclick="shareProfile('${data.data}','${data.dataName}')" class="fa fa-share"></i>
                    <h3>${data.dataName}</h3>
                    <div class="qrcode" id="qrcode${data.postID}">
                        <a class="number" href="${data.data}">
                            Follow ${data.dataName}
                        </a>
                    </div>
                    </div>
            `;
        }
        function displayInstaCard(data){
            document.getElementById(`postData${data.postID}`).innerHTML = `<div class="insta-card postCard">
             <i onclick="shareProfile('https://instagram.com/${data.data}','${data.dataName}')" class="fa fa-share"></i>
                        <h3>${data.dataName}</h3>
                        <div class="qrcode" style="--bg: url('<?php echo $folderLoc?>assets/qrImg/qr_${data.ID}.jpg');">
                            <a class="number" href="https://instagram.com/${data.data}" style="background: 
                            radial-gradient(circle at 30% 107%,
                             #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
                              box-shadow:
                                    0 4px 15px rgba(250, 126, 30, 0.3),
                                    0 6px 25px rgba(214, 41, 118, 0.3),
                                    0 10px 35px rgba(150, 47, 191, 0.3);
                            ">
                                Follow ${data.data}
                            </a>
                        </div>
                        </div>
            `
        }

        var allowToRequestPosts = 1;
        <?php if(!$likedPage){?>
        window.addEventListener("scroll", () => {
  const scrollTop = window.scrollY;
  const windowHeight = window.innerHeight;
  const documentHeight = document.documentElement.scrollHeight;
  const scrolledPercentage = (scrollTop + windowHeight) / documentHeight;
  if (scrolledPercentage >= 0.99) {
    if(allowToRequestPosts)
        fetch_post(1,'');
  }
});
  <?php }?>
    </script>
</body>
</html>