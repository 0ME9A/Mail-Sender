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

        .login-form-parent {
            background-color: transparent;
            box-shadow: none;
        }

        footer {
            height: auto;
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
    <?php
    session_start();
    if (isset($_SESSION) and sizeof($_SESSION) > 0) {
        require "functions.php";
        if ($_SESSION["admin"] != '' and $_SESSION["verify"] != '') {
            $admin_name = $_SESSION["admin"];
            $admin_key = $_SESSION["verify"];
            $result = check_exist_arr('adminlist', 'name', $admin_name, 'admin_key', $admin_key);

            if (sizeof($result) == 1) {
                echo '<article class="content-container-parent fj-c">
                <div class="content-container-first-child card-container">
                    <div class="card login-form-parent">
                        <div class="form" id="add-user">
                            <input type="text" placeholder="Username" id="add-user-name" name="name" require value="">
                            <input type="email" placeholder="Email" id="add-user-mail" name="mail" require value="">
                            <textarea name="self" id="add-user-self" placeholder="Tell us about youself!" value=""></textarea>
                        </div>
                    </div>
                </div>
            </article>';
            }
        }
    } else {
        header("Location: login.php");
    }

    ?>


    <footer>
        <div class="footer-containt-container">
            <div class="btn-group fja-c">
                <button type="submit" class="btn-m send-all update-user" id="add-user-btn" form="add-user" name="add-btn" value="new">add user</button>
            </div>
        </div>
    </footer>

    <script src="jsVar.js"></script>
    <script>
        let new_user_form = new Array(new_user, new_mail, new_self);



        function Show_info(name, mail, self, action) {
            console.log(name)
            console.log(mail);
            console.log(self);
            console.log(action);

            if (name == "" || mail == "" || action == "") {
                return;
            } else {
                var xmlhtpp = new XMLHttpRequest();
                xmlhtpp.onreadystatechange = function() {
                    console.log(this.status)
                    if (this.readyState == 4 && this.status == 200) {
                        alert_parent[0].style.opacity = 1;
                        console.log(this.responseText);
                        if (this.responseText == 1) {
                            alert_tag[0].innerHTML = "Account Created";
                            alert_tag[0].style.color = "green";
                        } else {
                            alert_tag[0].innerHTML = this.responseText;
                            alert_tag[0].style.color = "red";
                        }
                    } else {
                        console.log("cant send data");
                    }
                }
                xmlhtpp.open("POST", "serverToClient.php", true);
                xmlhtpp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhtpp.send("name=" + name + "&mail=" + mail + "&self=" + self + "&action=" + action);
            }
        }
        new_btn.onclick = function() {
            Show_info(new_user.value, new_mail.value, new_self.value, this.value);
        }
    </script>

</body>

</html>