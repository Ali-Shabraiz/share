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
    <style>
        .container.profileCardContainer{
            background: var(--secondWte);
            flex-direction: row;
            flex-wrap: wrap;
            /* justify-content: space-between; */
            gap: 25px;
            padding: 0;
        }
        .container.profileCardContainer .card{
            width: 275px;
            height: max-content;
            position: relative;
            /* overflow-y: hidden; */
        }
        .container.profileCardContainer .card .personalInfo{
            height: 100px;
            width: 100%;
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            border-radius: 10px 10px 0 0;
        }
        .container.profileCardContainer .card .personalInfo .fa-share{
            position: absolute;
            top : 0;
            right: 0;
            background: var(--secondWte);
            width: 35px;
            height: 35px;
            align-content: center;
            transform: translate(25%,-25%) rotate(0deg);
            border-radius: 50%;
            border: 3px solid transparent;
            border-right-color: var(--blk);
            border-top-color: var(--blk);
            
            

        }
        .container.profileCardContainer .card .personalInfo,
        .container.profileCardContainer .card .scores,
        .container.profileCardContainer .card .controls
        {
            padding: 10px;
            width: 100%;
            background: var(--wte);

        }

        .container.profileCardContainer .card .personalInfo img{
            height: 75px;
            width: 75px;
        }
        .container.profileCardContainer .card .scores{
            display: flex;
            justify-content: space-between;
            list-style: none;
            text-align: center;
        }
        .container.profileCardContainer .card .scores span{
            font-size: 0.8em;
            color: var(--grayText);
        }
        .container.profileCardContainer .card .social-links{
            display: flex;
            margin-top: 5px;
            background: var(--wte);
            padding: 10px;
            flex-wrap: wrap;
            gap: 10px;
            position: relative;
        }
        .container.profileCardContainer .card .social-links .fab,
        .container.profileCardContainer .card .social-links .fa{
            background: var(--secondWte);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            align-content: center;
            text-align: center;
            color: var(--blk);
            text-decoration: none;
        }
        .container.profileCardContainer .card .controls{
            display: flex;
            justify-content: space-between;
            border-radius: 0 0 10px 10px;
        }
        .container.profileCardContainer .card .social-links .fa-heart{
            position: absolute;
            top: 0;
            right: 0;
            transform: translate(50%,calc(-50% - 5px /2));
            border-radius: 50%;
            background: var(--secondWte);
            font-size: 1.3em;
            /*  background: red;  */
            outline: 5px solid var(--secondWte);
            width: 27px;
            height: 27px;
            align-content: center;
            color: var(--heartRed);
        }
        
        
       

        
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/CSS/style.css">
    <link rel="stylesheet" href="../assets/CSS/globalVariables.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiles</title>
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
                        <li><h6>Followers</h6><span>${profile.follower}</span></li>
                        <li><h6>Following</h6><span>${profile.following}</span></li>
                        <li><h6>Friends</h6><span>${profile.friends}</span></li>
                        <li><h6>Likes</h6><span>${profile.likes}</span></li>
                        <li><h6>Scores</h6><span>${profile.scores}</span></li>
                    </ul>
                    <ul class="social-links">
                        <i class="far fa-heart"></i>
                        <a href="../index.php?id=${profile.ID}" class="fa fa-share"></a>
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
                    <form class="controls" id="followForm_${profile.ID}" onsubmit="${followFunction(profile.isFollowed,profile.isFollowing)}('${profile.ID}')">
                        <input type="hidden" value="${profile.ID}" name="fID">
                        <input type="hidden" value="<?php  echo $MyData['ID']?>" name="id">
                        <button type="submit" class="dangerButton" style="width:100%;">${followText(profile.isFollowed,profile.isFollowing)}</button>
                    </form>
                    </div>
                    `;
            card.innerHTML = str;
            container.appendChild(card);
            });
            deActiveForms();
        }
        fetch_all_profiles();
        function followText(isFollowed,isFollowing){
            if(isFollowed && isFollowing)
                return "Unfriend";
            else if(isFollowed == 0 && isFollowing == 1)
                return "Unfollow";
            else if(isFollowing == 0 && isFollowed == 1)
                return "Follow Back";
            else 
                return "Follow";
        }
         function followFunction(isFollowed,isFollowing){
            if(isFollowed && isFollowing)
                return "unfollowHim";
            else if(isFollowed == 0 && isFollowing == 1)
                return "unfollowHim";
            else if(isFollowing == 0 && isFollowed == 1)
                return "followHim";
            else 
                return "followHim";
        }
        


function shareProfile(id,name) {
  if (navigator.share) {
    navigator.share({
      title: `Share about ${name}`,
      text: `See about ${name}`,
      url: `https://share.thedeepedits.com/profile/index.php?id=${id}`
    })
    .then(() => console.log('Shared successfully'))
    .catch((error) => console.log('Error:', error));
  } else {
    alert('Linked Copied');
    // navigator.clipboard.writeText(`https://share.thedeepedits.com/profile/index.php?id=${id}`);
  }
}

function followHim(id){
            console.log(id)
            $.ajax({
                url: '../PHP/followHim.php',
                method: 'POST',
                data: $(`#followForm_${id}`).serialize(),
                success: (data => {
                    fetch_all_profiles();
                })
            })
        }
        function unfollowHim(id){
            console.log(id)
            $.ajax({
                url: '../PHP/unFollowHim.php',
                method: 'POST',
                data: $(`#followForm_${id}`).serialize(),
                success: (data => {
                    fetch_all_profiles();
                })
            })
        }

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../nav.js"></script>
    <script src="../formDeactivator.js"></script>
</body>
</html>