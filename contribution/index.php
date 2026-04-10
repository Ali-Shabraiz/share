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

    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contribution - Share</title>
    <link rel="stylesheet" href="../assets/CSS/globalVariables.css">
    <link rel="stylesheet" href="../assets/CSS/style.css">
    <style>
        .cardsContainer{
            margin-top: 0;
        }
        .whatsAppCardsContainer{
            margin-top: 20px !important;
        }
        .cardsContainer,.whatsAppCardsContainer,.TikTokCardsContainer{
            background: var(--secondWte);
            flex-direction: row;
            flex-wrap: wrap;
            margin-top: 0;
            /* justify-content: space-between; */
            gap: 25px;
            padding: 0;
            display: flex;
        }
        .whatsAppCardsContainer .card,
        .TikTokCardsContainer .card,
        .instagramCardsContainer .insta-card
        {
            /* 25D366 */
            background: var(--wte);
            width: 275px;
            height: max-content;
            position: relative;
            display: flex;
            flex-direction: column;
            border-radius: 10px;
            align-items: center;
            padding-bottom: 20px;
            outline: 2px solid var(--clr);
        }
        .whatsAppCardsContainer .card .fa,
        .TikTokCardsContainer .card .fa,
        .instagramCardsContainer .insta-card .fa{
            border-bottom-color: var(--clr);
            border-left-color: var(--clr);
        }
        .whatsAppCardsContainer .card .profilePic{
            /* position: absolute; */
            left: 50%;
            transform: translateY(-50%);
            outline: 5px solid var(--wte);
            background : var(--wte);
            border-radius: 50%;
            margin-bottom: -15px;
        }
        .whatsAppCardsContainer .card h3,
        .TikTokCardsContainer .card h3,
        .instagramCardsContainer .insta-card h3
        {
            font-weight: 500;
            font-size: 1.2em;   
        }
        .whatsAppCardsContainer .card .chatBox,
        .TikTokCardsContainer .card .qrcode
        {
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
        .whatsAppCardsContainer .card .chatBox .number,
       .instagramCardsContainer .insta-card .qrcode .number,
       .TikTokCardsContainer  .qrcode .number


        {
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
        .whatsAppCardsContainer .card .chatBox .fab,
        .TikTokCardsContainer .card  .fab

        {
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
        .container label{
            width: 200px;
            height: max-content;
            background: var(--wte);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: center;
            
        }
        .container label .fa-plus{
            /* position: absolute; */
            /* top: 50%; */
            /* transform: translate(-50%,-50%); */
            width: 75px;
            height: 75px;
            background: var(--secondWte);
            align-content: center;
            text-align: center;
            font-size: 1.5em;
            color: var(--blk);
            border-radius: 50%;
        }
      
      
       
       .instagramCardsContainer .insta-card {
  position: relative;
  border-radius: 20px;
  padding: 20px;
  /* background: var(--wte); */
  box-shadow:
    0 2px 5px rgba(250, 126, 30, 0.3),
    0 3px 10px rgba(214, 41, 118, 0.3),
    0 5px 15px rgba(150, 47, 191, 0.3);
}
       .instagramCardsContainer .insta-card h3{
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
.qrcode {
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
.deletePostBtn{
    position: absolute;
    left: 0;
    top: 0;
    background: var(--secondWte);
            width: 35px;
            color: var(--blk);
            height: 35px;
            align-content: center;
            transform: translate(-25%,-25%);
            border-radius: 50%;
            border: 2px solid transparent;
            border-right-color: var(--blk);
            border-bottom-color: var(--blk);
            border-left-color: transparent !important;
            border-right-color: var(--clr);
            transition: 0.3s;
}
.deletePostBtn:hover{
    background: var(--heartRed);
    color: var(--wte);
    border-right-color: var(--heartRed);
    border-bottom-color: var(--heartRed) !important;
}


/* Hide original QR visually (but keep for mask) */


/* Gradient layer */

    </style>
    <script src="https://unpkg.com/qr-code-styling/lib/qr-code-styling.js"></script>
</head>
<body>
    <div class="main">
 <?php include "../assets/components/nav.php";?>
    <div class="content">
        <?php include "../assets/components/aside.php";?>
        <div class="info">
            <h2>WhatsApp</h2>
            <div class="whatsAppCardsContainer cardsContainer" id="whatsAppCardsContainer"></div>
            <h2>Facebook</h2>
            <div class="whatsAppCardsContainer cardsContainer" id="facebookCardsContainer"></div>
            <h2>Instagram</h2>
            <div class="instagramCardsContainer cardsContainer" id="instagramCardsContainer"></div>
            <h2>TikTok</h2>
            <div class="TikTokCardsContainer cardsContainer" id="TikTokCardsContainer"></div>
            <h2>Upload</h2>
            <div class="container whatsAppCardsContainer">
                <label for="addFormCheck" onclick="getAddForm('WhatsApp')"><h3>Add WhatsApp</h3><span class="fa fa-plus"></span></label>
                <label for="addFormCheck" onclick="getAddForm('Facebook')"><h3>Add Facebook</h3><span class="fa fa-plus"></span></label>
                <label for="addFormCheck" onclick="getAddForm('Instagram')"><h3>Add Instagram</h3><span class="fa fa-plus"></span></label>
                <label for="addFormCheck" onclick="getAddForm('Tiktok')"><h3>Add TikTok</h3><span class="fa fa-plus"></span></label>
                <label for="addFormCheck" onclick="getAddForm('Image')"><h3>Add Image</h3><span class="fa fa-plus"></span></label>
            </div>

        </div>

    </div>
    </div>
    <div class="forms">
        <input type="checkbox" id="addFormCheck" class="displayNone">
        <form  class="logIn" onsubmit="uploadPost('addForm')" id="addForm"></form>
        <input type="checkbox" id="editFormCheck" class="displayNone">
        <form  class="logIn" onsubmit="updatePost('editForm')" id="editForm"></form>
    </div>
    <script>
        function getAddForm(formName){
            console.log(formName)
            fetch(`../forms/addForm${formName}.html`).then(res => {
                return res.text()
            }).then(data => {
                document.getElementById('addForm').innerHTML = data;
            })
        }

         function getEditForm(formName,postID){
            console.log(formName)
            fetch(`../forms/editForm.php?postID=${postID}&FName=${formName}`).then(res => {
                return res.text()
            }).then(data => {
                document.getElementById('editForm').innerHTML = data;
            })
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
    navigator.clipboard.writeText(`https://share.thedeepedits.com/profile/index.php?id=${id}`);
  }
}
function uploadPost(id){
            let form = document.getElementById(`${id}`);
            let formData = new FormData(form);
            $.ajax({
                url: '../PHP/uploadPost.php',
                method: 'POST',
                data: formData,
                processData: false,   // don't convert FormData to string
                contentType: false,   // let browser set multipart/form-data
                success: (data => {
                    fetch_all_myPosts();
                })
            })
        }
        function updatePost(id){
            console.log(id)
            $.ajax({
                url: '../PHP/updatePost.php',
                method: 'POST',
                data: $(`#${id}`).serialize(),
                success: (data => {
                    fetch_all_myPosts();
                })
            })
        }
        function deletePost(id){
            console.log(id)
            $.ajax({
                url: '../PHP/deletePost.php',
                method: 'POST',
                data: {postID: id},
                success: (data => {
                    fetch_all_myPosts();
                })
            })
        }
        function fetch_all_myPosts(){
            fetch('../API/fetch_all_myPosts.php').then(res => {
                return res.json();
            }).then(data => {
                displayWaAccounts(data.filter(pro => pro.type == 1));
                displayFBAccounts(data.filter(pro => pro.type == 2));
                displayInsAccounts(data.filter(pro => pro.type == 4));
                displayTiktokAccounts(data.filter(pro => pro.type == 3));
            })
        }
        fetch_all_myPosts();
        function displayInsAccounts(data){
            let instagramCardsContainer = document.getElementById('instagramCardsContainer');
            instagramCardsContainer.innerHTML = '';
            data.forEach(profile => {
                let card = document.createElement('div');
                card.classList.add('insta-card');
                card.innerHTML = `
                        <i onclick="shareProfile('https://instagram.com/${profile.data}','${profile.name}')" class="fa fa-share"></i>
                        <i onclick="deletePost('${profile.ID}')" class="fa fa-trash deletePostBtn"></i>
                        <h3>${profile.name}</h3>
                        <label for="editFormCheck" onclick="getEditForm('Instagram','${profile.ID}')" class="fa fa-edit"></label>
                        <div class="qrcode" style="--bg: url('../assets/qrImg/qr_${profile.ID}.jpg');">
                            <a class="number" href="https://instagram.com/${profile.data}" style="background: 
                            radial-gradient(circle at 30% 107%,
                             #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
                              box-shadow:
                                    0 4px 15px rgba(250, 126, 30, 0.3),
                                    0 6px 25px rgba(214, 41, 118, 0.3),
                                    0 10px 35px rgba(150, 47, 191, 0.3);
                            ">
                                Follow ${profile.data}
                            </a>
                        </div>
                    `;
                instagramCardsContainer.appendChild(card);


                
            })

        }
        function displayTiktokAccounts(data){
            let tiktokIdContainer = document.getElementById('TikTokCardsContainer');
            tiktokIdContainer.innerHTML = '';
                data.forEach(profile => {
                    let card = document.createElement('div');
                    card.style.setProperty('--clr','#000')

                    card.classList.add('card');
                    card.innerHTML = `
                        <i onclick="deletePost('${profile.ID}')" class="fa fa-trash deletePostBtn"></i>
                        <i onclick="shareProfile('https://tiktok.com/@${profile.data}','${profile.name}')" class="fa fa-share"></i>
                    <label for="editFormCheck" onclick="getEditForm('TikTok','${profile.ID}')" class="fa fa-edit"></label>
                    <h3>${profile.name}</h3>
                    <div class="qrcode" id="qrcode${profile.ID}">
                        
                        <a class="number" href="https://tiktok.com/@${profile.data}">
                            Follow ${profile.data}
                        </a>
                    </div>
                    `;
                tiktokIdContainer.appendChild(card);

                const qrCode = new QRCodeStyling({
    width: 160,
    height: 160,
    data: `https://tiktok.com/@${profile.data}`,
    dotsOptions: {
        color: "#000",
        type: "dots"
    },
    backgroundOptions: {
        color: "transparent"
    }
});
qrCode.append(document.getElementById(`qrcode${profile.ID}`));

            });
        }
        
        function displayWaAccounts(data){
            let i = 0;
            
            let container = document.getElementById('whatsAppCardsContainer');
            container.innerHTML = '';
           data.forEach(profile => {
            i++;

            let card = document.createElement('div');
            card.style.setProperty('--clr','#25D366')
            card.classList.add('card')
            card.innerHTML = `
                    <img  src="../assets/image/noProfile${i%3}.png" class="profilePic" width="50">
                    <i onclick="deletePost('${profile.ID}')" class="fa fa-trash deletePostBtn"></i>
                    <i onclick="shareProfile('https://wa.me/${profile.data}','${profile.name}')" class="fa fa-share"></i>
                    <label for="editFormCheck" onclick="getEditForm('WhatsApp','${profile.ID}')" class="fa fa-edit"></label>
                    <h3>${profile.name}</h3>
                    <div class="chatBox" id="qrcode${profile.ID}">
                        <div class="fab fa-whatsapp"></div>
                        <a class="number" href="https://wa.me/${profile.data}">
                            Chat with ${profile.data}
                        </a>
                    </div>
            `;
            container.appendChild(card);


let qrCode = new QRCodeStyling({
    width: 160,
    height: 160,
    data: `https://wa.me/${profile.data}`,
    dotsOptions: {
        color: "#000",
        type: "square"
    },
    backgroundOptions: {
        color: "transparent"
    }
});

qrCode.append(document.getElementById(`qrcode${profile.ID}`));

           })
        }
        
         function displayFBAccounts(data){
             let container = document. getElementById('facebookCardsContainer');
             container.innerHTML = '';
           data.forEach(profile => {
            let card = document.createElement('div');
            card.classList.add('card')
            card.style.setProperty('--clr','#1877F2')
            card.innerHTML = `
                        <i onclick="deletePost('${profile.ID}')" class="fa fa-trash deletePostBtn"></i>
                    <i onclick="shareProfile('${profile.data}','${profile.name}')" class="fa fa-share"></i>
                    <label for="editFormCheck" onclick="getEditForm('FaceBook','${profile.ID}')" class="fa fa-edit"></label>
                    <h3 style="margin-top: 10px;">${profile.name}</h3>
                    <div class="chatBox" id="qrcode${profile.ID}">
                        <a class="number" href="${profile.data}">
                            Follow ${profile.name}
                        </a>
                    </div>
            `;
            container.appendChild(card);


const qrCode = new QRCodeStyling({
    width: 160,
    height: 160,
    data: `${profile.data}`,
    dotsOptions: {
        color: "#000",
        type: "square"
    },
    backgroundOptions: {
        color: "transparent"
    }
});

qrCode.append(document.getElementById(`qrcode${profile.ID}`));

           })
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../formDeactivator.js"></script>
</body>
</html>