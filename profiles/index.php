<?php 
if (isset($_COOKIE['userID'])) {
    $logoutBtn = '<button class="logOutBtn fa fa-sign-out" onclick="accountlogOut(`../`)"></button>';
}
else{
    $mainBtnFunction = "showSignUpLogInForm('../')";
}
$folderLoc = '../';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/CSS/style.css">
    <link rel="stylesheet" href="../assets/CSS/globalVariables.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../follow.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Profiles</title>
    <style>
        
        
        
       
.activeLiked{
    background : red !important;
    color: var(--wte) !important;
    
}
        
    </style>
</head>
<body>
    <form class="logIn" id="signUpLogInForm" onsubmit="logInSignUpFormAJAX(rootofSignLogForm)"></form>
    <div class="main">
        <?php include "../assets/components/nav.php";?>
    <div class="content">
        <?php include "../assets/components/aside.php";?>
        <div class="info">
            <h2>Profiles</h2>
            <div class="container profileCardContainer" id="profileCardContainer"></div>
        </div>
        
    </div>
    </div>
    <script>
        function fetch_all_profiles(){
            fetch('../API/fetch_all_profiles.php').then(res => {
                return res.json();
            }).then(data => {
                displayProfiles(data);
            });
        }
        function displayProfiles(data){
            var container = document.getElementById('profileCardContainer');
            container.innerHTML = ``;
            data.forEach(profile => {
                 var card = document.createElement('div');
                 card.classList.add('card');
            let str = `
                     <div class="personalInfo">
                        <i onclick="shareProfile('${profile.ID}','${profile.name}')" class="fa fa-share"></i>
                        <img src="../assets/image/${profile.img}" alt="${profile.name}">
                        <h4>${profile.name}</h4>
                        <a href="mailto:${profile.email}" class="grayText">${profile.email}</a>
                    </div>
                    <ul class="scores">
                        <li><h6>Followers</h6><span id="followersNumber${profile.ID}">${profile.follower}</span></li>
                        <li><h6>Following</h6><span id="followingNumber${profile.ID}">${profile.following}</span></li>
                        <li><h6>Friends</h6><span id="friendNumber${profile.ID}">${profile.friends}</span></li>
                        <li><h6>Likes</h6><span id="likeNumber${profile.ID}">${profile.likes}</span></li>
                        <li><h6>Scores</h6><span id="scoresNumber${profile.ID}">${profile.scores}</span></li>
                    </ul>
                    <ul class="social-links">
                        <i class="${(profile.likedByMe) ? 'fa' : 'far'} fa-heart" id="likeBtn${profile.ID}" onclick="likeIt('${profile.ID}')"></i>
                        <a href="../profile/?id=${profile.ID}" class="fa fa-share"></a>
                        `;
                        if(profile.whatsapp != null)
                       str += `<a href="https://wa.me/${profile.whatsapp}" class="fab fa-whatsapp"></a>`
                        if(profile.instagram != null)
                       str += `<a href="https:/instagram.com/${profile.instagram}" class="fab fa-instagram"></a>`
                        if(profile.tiktok != null)
                       str += `<a href="https://tiktok.com/@${profile.tiktok}" class="fab fa-tiktok"></a>`
                        if(profile.youtube != null)
                        str +=`a href="${profile.youtube}" class="fab fa-youtube"></a>`
                        if(profile.facebook != null)
                        str +=`<a href="${profile.facebook}" class="fab fa-facebook"></a>`
                     str +=`</ul>
                    <form class="controls" id="followForm_${profile.ID}" data-address="${followAddress(profile.isFollowed,profile.isFollowing)}" onsubmit="followHim('<?php echo $folderLoc;?>','${profile.ID}',this.dataset.address,'profilesAfterFollow')">
                        <button type="submit" class="dangerButton" style="width:100%;" id="followBtn${profile.ID}">${followText(profile.isFollowed,profile.isFollowing)}</button>
                    </form>
                    </div>
                    `;
            card.innerHTML = str;
            container.appendChild(card);
            });
            deActiveForms();
        }
        fetch_all_profiles();
        
        


function shareProfile(id,name) {
  if (navigator.share) {
    navigator.share({
      title: `Share about ${name}`,
      text: `See about ${name}`,
      url: `https://share.thedeepedits.com/profile/?id=${id}`
    })
    .then(() => console.log('Shared successfully'))
    .catch((error) => console.log('Error:', error));
  } else {
    alert('Linked Copied');
    // navigator.clipboard.writeText(`https://share.thedeepedits.com/profile/index.php?id=${id}`);
  }
}

 function likeIt(postID){
            $.ajax({
                url: '../PHP/likePost.php?profile=1',
                method: 'POST',
                data: {postID: postID},
                success: (data => {
                    console.log(data)
                    if(data.condition)
                    document.getElementById(`likeBtn${postID}`).classList.replace('far','fa');
                    else
                    document.getElementById(`likeBtn${postID}`).classList.replace('fa','far');

                    document.getElementById(`likeNumber${postID}`).textContent = data.likes;
                    document.getElementById(`scoresNumber${postID}`).textContent = Number(document.getElementById(`scoresNumber${postID}`).innerText) + data.scores;
                })
            })
        }


    </script>
    <script src="../formDeactivator.js"></script>
    <script src="../nav.js"></script>

</body>
</html>