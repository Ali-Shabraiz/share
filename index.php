<?php 
if (isset($_COOKIE['userID'])) {
    $logoutBtn = '<button class="logOutBtn fa fa-sign-out" onclick="accountlogOut(`./`)"></button>';
}
else{
    $mainBtnFunction = "showSignUpLogInForm('./')";

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/CSS/globalVariables.css">
    <link rel="stylesheet" href="./assets/CSS/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/qr-code-styling/lib/qr-code-styling.js"></script>
    <link rel="stylesheet" href="./assets/CSS/globalVariables.css">
    <script async src="https://www.tiktok.com/embed.js"></script>
    <title>Home - Share</title>
    <style>
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
        border-radius: 10px;
        border: 1px solid var(--blk);
    }
    .content .info .postContainer .postData:has(:not( .WACard)){
           overflow: visible;

       }
       .content .info .postContainer .postData img{
        width: 100%;
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
         .insta-card .fa{
            border-bottom-color: var(--clr);
            border-left-color: var(--clr);
            z-index: 11133;
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

        
    </style>
</head>
<body>
    <div class="main">
         <?php include "./assets/components/nav.php";?>
         <div class="content">
            <?php include "./assets/components/aside.php";?>
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
    <script>
       function fetch_top_five(){
            fetch('./API/fetch_top_profiles.php').then(res => {
                return res.json();
            }).then(data => {
                displayTopProfiles(data);
                displayFriendsImg(data);
            })
        }
        fetch_top_five();
        function displayTopProfiles(data){
            let profileContainer =  document.getElementById('profiles');
           profileContainer.innerHTML = ' <h4>New Users</h4>';
            data.forEach(profile => {
                var row = document.createElement('div');
                row.classList.add('profileRow');
                row.innerHTML = `
                    <div class="personalData">
                            <img src="./assets/image/${profile.img}">
                            <h5>${profile.name}</h5>
                            <h6>${profile.email}</h6>
                        </div>
                        <button>Follow</button>
                `;
                profileContainer.append(row);

            })
        }
        function displayFriendsImg(data){
            let i=0;
            let friendsImg =  document.getElementById('friendsImg');
            for(i=0;i<3;i++){
                let img = document.createElement('img');
                img.src = `./assets/image/${data[i].img}`;
                friendsImg.append(img);
}
        
        }
        function fetch_post(){
            fetch('./API/fetch_post.php').then(res => {
                return res.json()
            }).then(data => {
                displayPosts(data);
            })
        }
        fetch_post();
        function displayPosts(data){
            let postContainer = document.getElementById('postContainer');
            postContainer.innerHTML = ``;
            data.forEach(post => {
                let singlePost = document.createElement('div');
                singlePost.classList.add('singlePost');
                singlePost.innerHTML = `
                            <div class="uploadedBy">
                            <section>
                                <img src="./assets/image/${post.img}" alt="">
                                <h5>${post.name}</h5>
                                <h6 class="grayText">${post.date}</h6>
                            </section>
                            <section>
                                <button>Follow</button>
                                <span class="fa fa-ellipsis"></span>
                            </section>
                        </div>
                        <div class="postData" id="postData${post.ID}"></div>
                        <div class="details">
                            <section>
                                <span><i class="far fa-heart"></i> 3,924</span>
                                <span><i class="fa fa-commet"></i> 3,924</span>
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
            const qrCode = new QRCodeStyling({
    width: 160,
    height: 160,
    data: `https://wa.me/${data.data}`,
    dotsOptions: {
        color: "#000",
        type: "square"
    },
    backgroundOptions: {
        color: "transparent"
    }
});

qrCode.append(document.getElementById(`qrcode${data.ID}`));
        }
        
        function displaySwitch(data,type){
            console.log(document.getElementById(`postData${data.ID}`))
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
            }
        }
        function displayWACard(data){
            document.getElementById(`postData${data.ID}`).innerHTML = ` <div class="WACard postCard" style="--clr: #25D366"><img  src="./assets/image/noProfile0.png" class="profilePic" width="50">
                    <i onclick="shareProfile('https://wa.me/${data.data}','${data.dataName}')" class="fa fa-share"></i>
                    <h3>${data.dataName}</h3>
                    <div class="qrcode" id="qrcode${data.ID}">
                        <div class="fab fa-whatsapp"></div>
                        <a class="number" href="https://wa.me/${data.data}">
                            Chat with ${data.data}
                        </a>
                    </div>
                    </div>
            `;
        }
        function displayTikTokCard(data){
             document.getElementById(`postData${data.ID}`).innerHTML = ` <div class="TTCard postCard" style="--clr: #000">
                    <i onclick="shareProfile('https://tiktok.com/@${data.data}','${data.dataName}')" class="fa fa-share"></i>
                    <blockquote class="tiktok-embed" cite="https://tiktok.com/@${data.data}" data-unique-id="${data.data}" data-embed-type="creator"> <section> <a target="_blank" href="https://www.tiktok.com/@${data.data}?refer=creator_embed">${data.dataName}</a> </section> </blockquote>
                    </div>
                    `
                   
        }
        function displayFBCard(data){
            document.getElementById(`postData${data.ID}`).innerHTML = ` <div class="FBCard postCard" style="--clr: #1877F2">
                    <i onclick="shareProfile('${data.data}','${data.dataName}')" class="fa fa-share"></i>
                    <h3>${data.dataName}</h3>
                    <div class="qrcode" id="qrcode${data.ID}">
                        <a class="number" href="${data.data}">
                            Follow ${data.dataName}
                        </a>
                    </div>
                    </div>
            `;
        }
        function displayInstaCard(data){
            document.getElementById(`postData${data.ID}`).innerHTML = `<div class="insta-card postCard">
             <i onclick="shareProfile('https://instagram.com/${data.data}','${data.dataName}')" class="fa fa-share"></i>
                        <h3>${data.dataName}</h3>
                        <div class="qrcode" style="--bg: url('./assets/qrImg/qr_${data.ID}.jpg');">
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
    </script>
</body>
</html>