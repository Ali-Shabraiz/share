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
        overflow: hidden;
       }
       .content .info .postContainer .postData img{
        width: 100%;
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
                    <div class="postContainer" id="postContainer">
                        <div class="singlePost">
                            <div class="uploadedBy">
                            <section>
                                <img src="./assets/image/noProfile0.png" alt="">
                                <h5>Mr. Unknown Man</h5>
                                <h6 class="grayText">4 Apr. 2025</h6>
                            </section>
                            <section>
                                <button>Follow</button>
                                <span class="fa fa-ellipsis"></span>
                            </section>
                        </div>
                        <div class="postData">
                            <img src="./assets/image/img_69cf46b74df0a3.35643666.jpg" alt="">
                        </div>
                        <div class="details">
                            <section>
                                <span><i class="far fa-heart"></i> 3,924</span>
                                <span><i class="fa fa-commet"></i> 3,924</span>
                            </section>
                            <section>
                                <p>انا لله وانا اليه راجعون 😢💔</p>
                            </section>
                        </div>
                        </div>
                        
                    </div>
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
                        <div class="postData">
                            <img src="./assets/image/img_69cf46b74df0a3.35643666.jpg" alt="">
                        </div>
                        <div class="details">
                            <section>
                                <span><i class="far fa-heart"></i> 3,924</span>
                                <span><i class="fa fa-commet"></i> 3,924</span>
                            </section>
                            <section>
                                <p>انا لله وانا اليه راجعون 😢💔</p>
                            </section>
                        </div>
                        
                `;
                postContainer.append(singlePost)


            })
        }

        function displaySwitch(data,type){
            switch(type){
                case 1: return displayWACard(data);
                break;
                case 2: return displayWACard(data);
                break;
                case 3: return displayWACard(data);
                break;
                case 4: return displayWACard(data);
                break;
                
            }
        }
    </script>
</body>
</html>