var rootofSignLogForm = './';
var menuIcon = document.querySelector("nav .menuIcon");
        var menuBar = document.querySelector("nav .menuBar");
        var signUpLogInForm = document.getElementById('signUpLogInForm');
        function toggleAsideCart() {
            var cart = document.getElementById("cart");
            cart.classList.toggle('active');
        }
        function toggleMenu() {
            if (menuIcon.classList.contains('fa-bars')) {
                menuBar.classList.add("show");
                menuIcon.classList.replace("fa-bars", "fa-times");
            }
            else {
                menuIcon.classList.replace("fa-times", "fa-bars");
                menuBar.classList.remove("show");

            }
        }
        function getSignUPLoginFunctionNum(value) {
            switch (value) {
                case 'loginForm': return 2;
                    break;
                case 'signupForm': return 1;
                    break;
            }
        }
        function getSignLogForm(name,url) {
            fetch(`${url}${name}.txt`).then(res => {
                return res.text();
            }).then(text => {
                signUpLogInForm.innerHTML = text;
            })
        }
        function showSignUpLogInForm(url) {
            rootofSignLogForm = url;
            if (signUpLogInForm.innerHTML == "")
                getSignLogForm('loginForm',url);

            signUpLogInForm.classList.add("active");
        }
        function notShowUplogInForm() {
            signUpLogInForm.classList.remove("active");

        }
   
        function logInSignUpFormAJAX(url) {
            let num = document.querySelector("#signUpLogInForm button").value;
            switch (num) {
                case '1': createNewAccount(url);
                    break;
                case '2': logIntoAccount(url);
                    break;
            }
        }
        function createNewAccount(url) {
            $.ajax({
                url: `${url}PHP/createUserAccount.php`,
                method: 'POST',
                data: $('#signUpLogInForm').serialize(),
                success: (data) => {
                    console.log(data);
                    if(data == 'User-already-exist')
                        getSignLogForm('loginForm');
                    else if(data == 'user-created')
                        window.location.reload(); 
                    // a
                }
            });
        }
        function logIntoAccount(url){
            $.ajax({
                url: `${url}PHP/userLogIn.php`,
                method: 'POST',
                data: $('#signUpLogInForm').serialize(),
                success: (data) => {
                    if(data == 'NO')
                        getSignLogForm('signupForm');
                    else    
                        window.location.reload();
                }
            });
        }
        function accountlogOut(url){
            $.ajax({
                url: `${url}PHP/userlogout.php`,
                method: 'POST',
                success: (data) => {
                    window.location.reload();
                }
            });
        }