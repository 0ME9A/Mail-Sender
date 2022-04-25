<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;

        }

        .card {
            background-color: transparent !important;
            box-shadow: none;
        }


        footer {
            height: auto;
        }



        .card {
            position: relative;
            /* width: 100%; */
            flex-wrap: wrap;
            text-align: center;
            box-shadow: none;
            /* background-color: gold !important; */
        }

        .profile-img {
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
            border-radius: 50%;
            overflow: hidden;
            align-self: flex-start;
            /* background-color: gold; */
        }

        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-user {
            width: 100%;

        }

        .content-container-parent {
            margin-top: -250px;
        }

        .background-img-container {
            position: fixed;
        }
    </style>
</head>

<body>

    <?php
    require "nav.php";
    ?>
    <div class="alert fja-c">
        <div class="alert-box fja-c">
            <h2 class="alert-tag">this is alert</h2>
        </div>
    </div>


    <div class="background-container">
        <div class="background-img-container">
            <img src="https://images.unsplash.com/photo-1606162555134-6b625614d5c0?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" alt="">
        </div>
    </div>
    <article class="content-container-parent fj-c">
        <div class="content-container-first-child card-container">
            <div class="card login-form-parent">
                <div class="profile-img">
                    <img src="https://images.unsplash.com/photo-1566169688293-727ed95b62f9?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&q=80" alt="">
                </div>
                <div class="form" id="login-form">
                    <input type="email" placeholder="email" require id="login-mail">
                    <input type="password" placeholder="password" require id="login-pass">
                    <a href="forget.html" id="forgot">forgot username/password</a>
                </div>
            </div>
        </div>
    </article>
    <footer>
        <div class="footer-containt-container">
            <div class="btn-group fja-c">
                <button type="submit" class="btn-m send-all update-user" id="login-btn" value="login">log in</button>
            </div>
        </div>
    </footer>

    <script src="jsVar.js"></script>t
    <script>

        function Show_info(mail, pass, action) {
            if (mail == "" || pass == "") {
                return;
            } 
            else {
                var xmlhtpp = new XMLHttpRequest();
                xmlhtpp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        alert_parent[0].style.opacity = 1;
                        console.log(this.responseText);
                        if (this.responseText == 1) {
                            alert_tag[0].innerHTML = "Access gurented";
                            alert_tag[0].style.color = "green";
                            setTimeout(() => {
                                window.location.href = "index.php";
                            }, 1000);
                        } else {
                            alert_tag[0].innerHTML = this.responseText;
                            alert_tag[0].style.color = "red";
                        }
                    }
                }
                xmlhtpp.open("POST", "serverToClient.php", true);
                xmlhtpp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhtpp.send("mail=" + mail + "&pass=" + pass + "&action=" + action);
            }
        }


        login_btn.onclick = function() {
            mail = login_mail.value;
            pass = login_pass.value;
            action = login_btn.value;

            Show_info(mail, pass, action);
        }


        // ajax send data end---------------------
    </script>
</body>

</html>