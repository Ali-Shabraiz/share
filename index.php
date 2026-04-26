<?php 
if(!isset($folderLoc))
    $folderLoc = './';
if(!isset($likedPage)){
    $likedPage = 0;
}  
if(!isset($reelPage)){
    $reelPage = 0;
}
    if (isset($_COOKIE['userID'])) {
    $logoutBtn = '<button class="logOutBtn fa fa-sign-out" onclick="accountlogOut(`./`)"></button>';
}
else{
    $mainBtnFunction = "showSignUpLogInForm('./')";
}
if(isset($_GET['sharedPost'])){
    $sharedPostC = true;
    $sharedPost = $_GET['sharedPost'];
}
else    
    $sharedPostC = false;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo $folderLoc?>assets/CSS/globalVariables.css">
    <link rel="stylesheet" href="<?php echo $folderLoc?>assets/CSS/style.css">
    <link rel="stylesheet" href="<?php echo $folderLoc?>assets/CSS/reelAndPost.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/qr-code-styling/lib/qr-code-styling.js"></script>
    <link rel="stylesheet" href="<?php echo $folderLoc?>assets/CSS/globalVariables.css">
    <script async src="https://www.tiktok.com/embed.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?php echo $folderLoc?>follow.js"></script>
    <script src="<?php echo $folderLoc?>formDeactivator.js"></script>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
<style>
    :root{
        --comentSectionWidth: 300px;
    }
    
    .swiper{
        width: 100%;
        position: relative;
    }
        .swiper-slide {
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: relative;
      height: 90%;
      width: 100%;
      /* padding: 10px 0; */
    }
    .swiper-slide .data{
        width: max-content;
        max-width: 450px;
        height: 100%;
        display: flex;
        position: relative;
        padding: 10px;

    }
    .swiper-slide .data .information{
        z-index: 1;
        position: absolute;
        bottom: 20px;
        color: var(--wte);
        left: 20px;
        width: calc(90% - 50px);
    }
    .swiper-slide video {
      display: block;
      /* width: auto; */
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
      border-radius: 20px;
      /* border-radius: 20px; */
    }
    .swiper-wrapper{
        width: 100%;
    }
    .posts:has( #reelsContainer){
        height: calc(100vh - var(--navHeight));
        min-height: 450px;
    }
   .swiper .controls{
        position: absolute;
        z-index: 11;
        display: flex;
        gap: 10px;
        top: 20px;
        left: 20px;
    }
   .swiper .controls span{
        width: 35px;
        height: 35px;
        background: var(--wte);
        color: var(--blk);
        align-content: center;
        text-align: center;
        border-radius: 50%;
    }
    .preNextIcons {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        position: fixed;
        top: 50%;
        right: var(--comentSectionWidth);
        z-index: 11;
        height: max-content;
        transform: translateY(-50%);
        padding-right: 20px;
    }
    ::-webkit-scrollbar {
        width: 0;
    }
    .preNextIcons  div{
        width: 50px;
        height: 50px;
        border-radius: 50%;
        align-content: center;
        text-align: center;
        background: var(--wte);
    }
    .singleReel{
        display: flex;
        /* background: red; */
        gap: 0px;
        /* justify-content: center; */
    }
    .singleReel .navigation{
        /* background: black; */
        /* width: 100%; */
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 20px 10px;
        gap: 10px;
    }
    .singleReel .navigation .icon{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        /* gap: 5px; */
        position: relative;
        width: 50px;
        height: 50px;
    }
    .singleReel .navigation .icon:has(img){
        margin-bottom: 20px;
    }
    .singleReel .navigation .icon img{
        width: 100%;
        border-radius: 50%;
    }
    .singleReel .navigation .icon .followIcon{
        width: 25px;
        height: 25px;
        position: absolute;
        border-radius: 50%;
        background: var(--heartRed);
        color: var(--wte);
        font-size: 14px;
        bottom: -10px;
        align-content: center;
        text-align: center;
        /* transform: translateY(50%); */
    }
    .singleReel .navigation .icon .followIcon.active{
        background: var(--secondWte);
        color: var(--heartRed);
    }
    .singleReel .navigation .icon span:first-child{
        /* background: red; */
        font-size: 1.2em;
    }
    .commentSection{
        background: var(--wte);
        position: relative;
        max-height: 100%;
        height: calc(100vh - var(--navHeight));
        padding: 10px 10px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-width: var(--comentSectionWidth);
        gap: 10px;
        /* border-left: 1px solid var(--heartRed); */
        
    }
    .commentSection form {
        padding: 3px;
        border-radius: 30px;
        background: var(--wte);
        border: 2px solid var(--heartRed);
        min-height: 45px;
        flex-wrap: nowrap;
        display: flex;
        
        
    }
    .commentSection .crossIcon{
        position: absolute;
        right: 10px;
        top: 10px;
    }
    .commentSection form button,
    .commentSection form input{
        padding: 10px 10px;
        background: var(--wte);
        color: var(--blk);
        width: 245px;
        border-radius: 30px;
        border: none;
    }
    .commentSection form button{
        width: max-content;
        background: var(--heartRed);
        color: var(--wte);
    }
    .commentSection .allComments{
        height: 100%;
        overflow: auto;
        padding: 10px;
        position: relative;
    }
    .commentSection .allComments .singleComment{
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    .commentSection .allComments .singleComment .commentedBy{
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .commentSection .allComments .singleComment .commentedBy img{
        border-radius: 50%;
        width: 35px;
    }
    .commentSection .allComments .singleComment p{
        font-size: 0.8em;
        text-align: justify;
    }
   
    @media (max-width: 850px){
     
    
    .singleReel .navigation{
        position: absolute;
        right: 5px;
        bottom: 0;
    }
    .singleReel .navigation .icon{
        color: var(--wte);
        --blk: var(--wte);
        text-shadow: 0 0 5px var(--grayText);
        
    }
    }
    @media (max-width: 760px){
        .preNextIcons{
            display: none;
        }
        .commentSection{
            position: fixed;
            z-index: 11;
        }

        
    }
    
    @media (max-width: 460px){
        .swiper{
        width: 100%;
    }
    
    }

    .videoVolumeBtn{
        position: absolute;
        width: 30px;
        height: 30px;
        align-content: center;
        text-align: center;
        bottom: 10px;
        background: var(--wte);
        color: var(--blk);
        border-radius: 10px;
        right: 10px;
    }
    .playPauseIcon{
        position: absolute;
        font-size: 2em;
        color: var(--wte);
        opacity: 0.6;
        transition: 0.3s;
        top: 50%;
        transform: translateY(-50%);
    }
    .playPauseIcon.fa-pause{
        opacity: 0;
    }
</style>
    <title>Home - Share</title>
    
</head>
<body>
    <div class="main">
         <?php include $folderLoc."assets/components/nav.php";?>
         <div class="content">
            <?php include $folderLoc."assets/components/aside.php";?>
            <div class="info">
                <div class="posts">
                    <?php if(!$reelPage){?>
                    <div class="postContainer" id="postContainer"></div>
                    <?php }else {?>
                        <div class="swiper">
                            <div class="controls">
        <span class="playPauseBtn fa fa-pause" onclick="playPauseVideo(paused,this)"></span>
        <span class="volumeBtn fa fa-volume-xmark" onclick="videoVolume(volume,document.querySelectorAll('.volumeBtn'))"></span>
        </div>
    <div class="swiper-wrapper" id="reelsContainer">
        
    </div>
  </div>
                    <?php }?>

                </div>
                <?php if(!$reelPage){?>
                <aside class="accountsAndLinks">
                    <div class="profiles" id="profiles"></div>
                    <div class="friends">
                        <h3><span class="fa fa-user-friends"></span> Message</h3>
                        <div class="friendsImg" id="friendsImg"></div>
                    </div>
                </aside>
                <?php } else {?>
                    <div  class="preNextIcons">
                            <div class="pre fa fa-arrow-up" onclick="volumeFirst(volumeFirstCondition);"></div>
                            <div class="xt fa fa-arrow-down" onclick="volumeFirst(volumeFirstCondition);"></div>
                    </div>
                    
                <?php }?>
                <div class="commentSection" style="<?php echo (!$reelPage) ? 'position: fixed;display: none;' : '';?>">
                        <span class="fa fa-times crossIcon" onclick="displayCommitsBox('dummy_id')"></span>
                        <h3>Comments</h3>
                    <div class="allComments" id="commentBox">
                        
                    </div>
                    <?php if($reelPage){?> 
                    <form onsubmit="addComment(this.dataset.postid)" id="commentForm">
                    <input type="hidden" id="commentFormHidden" value="${post.ID}" name="on">
                    <input type="text" placeholder="Enter Your Comment" required name="comment">
                    <button type="submit">Send</button>
                </form>
                <?php }?>
                </div>
                
            </div>
         </div>
    </div>
    <script src="<?php echo $folderLoc?>nav.js"></script>
    <script>
        var volumeFirstCondition = true;
        function volumeFirst(condition){
           if(condition){
             volume = true;
            videoVolume(!volume,document.querySelector('.volumeBtn'));
           }
           volumeFirstCondition = false;
        }
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
                displayFriendsImg(data);
                <?php if(!$reelPage){?>
                displayTopProfiles(data);
                <?php }?>
            })
        }
        fetch_top_five();
                <?php if(!$reelPage){?>
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
        <?php }?>
        function displayFriendsImg(data){
            let i=0;
            let friendsImg =  document.getElementById('friendsImg');
            for(i=0;i<3;i++){
                let img = document.createElement('img');
                img.src = `<?php echo $folderLoc?>assets/image/${data[i].img}`;
                friendsImg.append(img);
}
        
        }
        function fetch_post(scrolled,firstReq<?php echo ($reelPage) ? ",initialSlideNum": "";?>)
        {
       <?php $pageType =  ($reelPage) ? 'reels' : 'Posts'; ?>
            allowToRequestPosts = 0;
            fetch(`<?php echo $folderLoc?>API/fetch_post.php${firstReq}`).then(res => {
                return res.json()
            }).then(data => {
                display<?php echo $pageType?>(data,!scrolled<?php echo ($reelPage) ? ",initialSlideNum": "";?>);
                allowToRequestPosts = 1;
            })
        }

                function likeIt(postID){
            $.ajax({
                url: '<?php echo $folderLoc?>PHP/likePost.php',
                method: 'POST',
                data: {postID: postID},
                success: (data => {
                    let likeBtn = document.querySelectorAll(`.likeBtn${postID}`);
                    let likeCount = document.querySelectorAll(`.likeCount${postID}`);
                    likeBtn.forEach(btn => {
                      btn.style.color = `var(${data.color})`;
                        })
                    likeCount.forEach(btn => {
                            btn.textContent = ' '+data.likes;
                        })
                    if(data.condition){
                        likeBtn.forEach(btn => {
                            btn.classList.replace('far','fa');
                        })
                          
                }
                    else{
                        likeBtn.forEach(btn => {
                            btn.classList.replace('fa','far');
                        })
}
                })
            })
        }
        function displayCommitsBox(id){
            isCommentsSectionDisplayed = !isCommentsSectionDisplayed;
            fetch_comments(id,isCommentsSectionDisplayed);
            <?php if($reelPage){?>
            placeNextPreButtons(isCommentsSectionDisplayed);
            <?php } else { ?>
            if(isCommentsSectionDisplayed)
                document.querySelector('.commentSection').style.display = 'flex';
            else
                document.querySelector('.commentSection').style.display = 'none';
            <?php }?>
        }
        <?php if($reelPage){?> 
        function placeNextPreButtons(condition){
            if(condition){
                document.querySelector('.preNextIcons').style.right = 'var(--comentSectionWidth)';
                document.querySelector('.commentSection').style.display = 'flex';

            }
            else{
                document.querySelector('.preNextIcons').style.right = '20px';
                document.querySelector('.commentSection').style.display = 'none';
            }
        }
        <?php  } ?>
        function addComment(id){
            $.ajax({
                url: '<?php echo $folderLoc?>PHP/addComit.php',
                method: 'POST',
                data: $(`#commentForm<?php echo (!$reelPage) ? '${id}' : ''?>`).serialize(),
                success: (data => {
                    displayAddComent(data);
                     let commentsCount = document.querySelectorAll(`.commentCount${id}`);
                    commentsCount.forEach(counter => {
                        counter.innerText = data.comments;
                    })
                })
            })
        }
        let isCommentsSectionDisplayed = 0;
        <?php if($reelPage){?>
        placeNextPreButtons(isCommentsSectionDisplayed);
       
        <?php } ?>

        function displayAddComent(data){
            var container = document.getElementById(`commentBox`);
            let commentDiv = document.createElement('div');
            commentDiv.classList.add('singleComment');
                        commentDiv.innerHTML = `
                            <div class="commentedBy">
                                <img src="<?php echo $folderLoc;?>assets/image/${data.img}">
                                <h5 class="grayText">${data.commentBy}</h5>
                            </div>
                            <p>${data.comment}</p>`
                           container.insertBefore(commentDiv,container.firstChild); 
        }
         function fetch_comments(id,condition){
            if(condition){
                $.ajax({
                url: '<?php echo $folderLoc?>API/fetch_comments.php',
                method: 'POST',
                data: {postID:id},
                success: (data => {
                    displayComments(data,id);
                   
                })
            })
            }
        }
        function displayComments(data,id){
            var container = document.getElementById(`commentBox`);
            container.innerHTML = '';
            if(data.code == 200){
                data.message.forEach(comit => {
                    let commentDiv = document.createElement('div');
            commentDiv.classList.add('singleComment');
                        commentDiv.innerHTML = `
                            <div class="commentedBy">
                                <img src="<?php echo $folderLoc?>assets/image/${comit.img}">
                                <h5 class="grayText">${comit.commentBy}</h5>
                            </div>
                            <p>${comit.comment}</p>`
                            container.append(commentDiv);
                })
            } else if(data.code == 404){
                container.innerHTML = data.message
            }

        }
        fetch_post(0,'?firstReq=1<?php echo $sharedPostC ? '&sharedPost='.$sharedPost: '';?><?Php echo ($likedPage) ? "&likePage=1":"";echo ($reelPage)? "&reelPage=1": ""?>');
        <?php if(!$reelPage){?>
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
                                <span onclick="likeIt('${post.ID}')"><i class="likeBtn${post.ID} ${post.likebyMe ? 'fa' : 'far'} fa-heart" style="color: var(${(post.likebyMe) ? '--heartRed': '--blk'})"></i><span class="likeCount${post.ID}"> ${post.likes}</span></span>
                                <span onclick="displayCommitsBox('${post.ID}')"><i class="far fa-comment"></i> <span class="commentCount${post.ID}">${post.comments}</span></span>
                            </section>
                            <section>
                                <p>${post.message}</p>
                            </section>
                            <form onsubmit="addComment('${post.ID}');displayCommitsBox('${post.ID}');" id="commentForm${post.ID}">
                    <input type="hidden" id="commentFormHidden" value="${post.ID}" name="on">
                    <input type="text" placeholder="Enter Your Comment" required name="comment">
                    <button type="submit">Send</button>
                </form>
                        </div>
                        
                `;
                postContainer.append(singlePost);
                displaySwitch(post,post.type);
            })
            deActiveForms();
            <?php if(!$reelPage){?>
                observerPlayPause();
                <?php }?>
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
            } else if(type == 5){
                displayImage(data)
            } else if(type == 6){
                displayVideo(data)
            }
                
        }
        function displayVideo(data){
             document.getElementById(`postData${data.postID}`).innerHTML = `
                <video data-postid="${data.postID}" onclick="playPauseVideo(this,paused,document.querySelector('.playPauseIcon'))" src="<?php echo $folderLoc?>assets/video/${data.data}" ${volume ? '' : 'muted'} loop></video>
                <span class="fa fa-pause playPauseIcon"></span>
                <span class="fa ${volume ? 'fa-volume-high' : 'fa-volume-xmark'} videoVolumeBtn" onclick="videoVolume(volume,document.querySelectorAll('.videoVolumeBtn'))"></span>
             `
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
                        <div class="qrcode" style="background: url('<?php echo $folderLoc?>assets/qrImg/qr_${data.ID}.jpg'), radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);background-size: cover;">
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
        <?php } else {?>
        let firstReel = 1;
        function displayreels(data,scroll,initialSlideNum){
            var container = document.getElementById('reelsContainer');
            data.forEach(reelD => {
                var reel = document.createElement('div');
                reel.classList.add('swiper-slide');
                reel.classList.add('singleReel');
                reel.innerHTML = `
                <div class="data">
                <video data-postid="${reelD.ID}" src="../assets/video/${reelD.data}" ${firstReel == 1 ? 'autoplay muted': ''} ${(volume) ? '' : 'muted'} loop></video>
                <div class="information">
                <h4>${reelD.dataName}</h4>
                <p>${reelD.message}</p>
                </div>
                <div class="navigation">
                    <div class="icon"><img src="../assets/image/${reelD.img}"><span class="reelFollowBtn${reelD.uID} followIcon ${reelD.isFollowing ? 'active' : ''} fa ${reelD.isFollowing ? 'fa-check' : 'fa-plus'}"  data-address="${followAddress(reelD.isFollowed,reelD.isFollowing)}" onclick="followHim('<?php echo $folderLoc?>','${reelD.uID}',this.dataset.address,'reelAfterFollow')"></span></div>
                    <div class="icon" onclick="likeIt('${reelD.ID}')"><span id="likeBtn${reelD.ID}" class="likeBtn${reelD.ID} ${reelD.likebyMe ? 'fa' : 'far'} fa-heart" style="color: var(${(reelD.likebyMe) ? '--heartRed': '--blk'})"></span><span class="likeCount${reelD.ID}">${reelD.likes}</span></div>
                    <div for="commentsCheck" onclick="displayCommitsBox('${reelD.ID}')" class="icon"><span class="far fa-comment"></span><span class="commentCount${reelD.ID}">${reelD.comments}</span></div>
                    <div class="icon"><span class="fa fa-share"></span></div>
                </div>
                </div>
                <div class="spacer" width: 220px;></div>
                

                `;
                container.append(reel);
                if(firstReel == 1){
                    document.getElementById('commentForm').dataset.postid = reelD.ID;
                    document.getElementById('commentFormHidden').value = reelD.ID;
                }
               (firstReel == 1) ? fetch_comments(reelD.ID,isCommentsSectionDisplayed) :  2 + 2;
                firstReel++;
            })
            initializeSwiper(initialSlideNum);
            deActiveForms();
        }

        <?php }?>

        var allowToRequestPosts = 1;
        <?php if(!$likedPage){?>
        window.addEventListener("scroll", () => {
  const scrollTop = window.scrollY;
  const windowHeight = window.innerHeight;
  const documentHeight = document.documentElement.scrollHeight;
  const scrolledPercentage = (scrollTop + windowHeight) / documentHeight;
  if (scrolledPercentage >= 0.99) {
    if(allowToRequestPosts){
        fetch_post(1,'');
}
  }
});
  <?php }?>
    </script>
     <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
  <script>
    function playPauseVideo(<?php echo !$reelPage ? 'activeVideo,' : ''?>condition,icon){
        <?php if($reelPage){?>
        const activeVideo = document.querySelector('.swiper-slide-active video');
        <?php } ?>
        if(!condition){
            activeVideo.pause();
            paused = true;
            icon.classList.replace('fa-pause','fa-play')
        }
        else{
            activeVideo.play();
            paused = false;
            icon.classList.replace('fa-play','fa-pause')
        }
        
    }
    var volume = false;
    var paused = false;
    function videoVolume(condition,icons){
        if(condition){
            volume = false;
        document.querySelectorAll('<?php echo ($reelPage) ? ".swiper-slide" : ".content .info .postContainer .postData"?> video').forEach(video => {
                video.muted = true;
                icons.forEach(icon => icon.classList.replace('fa-volume-high','fa-volume-xmark')); 
            });
            }
         else{
             volume = true;
        document.querySelectorAll('<?php echo ($reelPage) ? ".swiper-slide" : ".content .info .postContainer .postData"?> video').forEach(video => {
            video.muted = false;
            icons.forEach(icon => icon.classList.replace('fa-volume-xmark','fa-volume-high')); 

            });

    }
}
 function initializeSwiper(initialSlideNum) {
  var swiper = new Swiper('.swiper', {
    direction: "vertical",
    grabCursor: true,
    threshold: 1,
    initialSlide: initialSlideNum,
    speed: 400,
    snapToSlideEdge: true,
    grabCursor: true,
    slideToClickedSlide: true,
    navigation: {
      nextEl: ".xt",
      prevEl: ".pre"
    },
    mousewheel: {
    releaseOnEdges: true,
    thresholdDelta: 25,
    thresholdTime: 100
  },






    on: {
      slideChangeTransitionEnd: function () {
          // Pause & mute all videos
          var videoIndex = 0;
          document.querySelectorAll('.swiper-slide video').forEach(video => {
              if(!(videoIndex == this.activeIndex)){
                  video.pause();
                  video.currentTime = 0;
                }
                videoIndex++;
            });
            if (this.activeIndex > this.slides.length - 2){
                fetch_post(1,'?reelPage=1',this.activeIndex);
            }
            
            // Get active slide video
            const activeVideo = document.querySelector('.swiper-slide-active video');
            if (activeVideo) {
                document.getElementById('commentFormHidden').value = activeVideo.dataset.postid;
                document.getElementById('commentForm').dataset.postid = activeVideo.dataset.postid;
                fetch_comments(activeVideo.dataset.postid,isCommentsSectionDisplayed);
                activeVideo.play();
                paused = false;
                document.querySelector('.playPauseBtn').classList.replace('fa-play','fa-pause');
        }
      }
    }
  });

  // Optional: first user interaction unlocks sound
}
  </script>
  <script>
   function observerPlayPause() {

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {

      const video = entry.target;

      if (entry.isIntersecting) {
         document.querySelector(`#postData${video.dataset.postid} .playPauseIcon`).classList.replace('fa-play','fa-pause')
        video.play().catch(() => {});
      } else {
        video.pause();
         document.querySelector(`#postData${video.dataset.postid} .playPauseIcon`).classList.replace('fa-pause','fa-play')
      }
    });
  }, {
    threshold: 0.6
  });

  document.querySelectorAll("video").forEach(video => {
    observer.observe(video);
  });

}

            deActiveForms();

  </script>
  
</body>
</html>

