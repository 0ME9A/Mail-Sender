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

        .btn-group {
            flex-wrap: wrap;
            gap: 10px;
        }

        footer {
            height: auto;
        }

        .delete-user {
            color: red;
        }

        .delete-user:hover {
            background-color: red;
        }

        .card {
            position: relative;
            /* width: 100%; */
            flex-wrap: wrap;
            text-align: center;
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
            <h2>this is alert</h2>
        </div>
    </div>

    <div class="background-container">
        <div class="background-img-container">
            <img src="https://images.unsplash.com/photo-1606162555134-6b625614d5c0?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" alt="">
        </div>
    </div>
    <article class="content-container-parent fj-c">
        <div class="content-container-first-child card-container">
            <div class="card">
                <?php
                session_start();
                if (isset($_SESSION) and sizeof($_SESSION)>0) {
                    require "functions.php";
                    if ($_SESSION["admin"] != '' and $_SESSION["verify"] != '') {
                        $admin_name = $_SESSION["admin"];
                        $admin_key = $_SESSION["verify"];
                        $result = check_exist_arr('adminlist', 'name', $admin_name, 'admin_key', $admin_key);

                        foreach ($result as $row) {
                            echo '<div class="profile-img">
                                <img src="https://images.unsplash.com/photo-1566169688293-727ed95b62f9?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&q=80" alt="">
                            </div>
                            <div class="card-content">
                            <div class="card-header">
                            <h2 class="card-user" contenteditable="true">'.$row["name"].'</h2>
                            </div>
                            <a href="mailto:'.$row["mail"].'" class="card-mail" contenteditable="true">'.$row["mail"].'</a>
                            <p contenteditable="true">'.$row["self"].'</p>
                            </div>';
                        }
                    }
                } 
                else{
                    header("Location: login.php");
                }

                ?>

            </div>

        </div>
    </article>
    <div class="confirm-container fja-c">
        <div class="confirm-action-btn-box fja-c">
            <div class="close-alert-btn icon-box fja-c">
            <i class="fa-solid fa-xmark"></i>
            </div>
            <button type="submit" value="" class="confirm-action-btn btn-m" id="send_action_btn">confirm action</button>
        </div>
    </div>
    <footer>
        <div class="footer-containt-container">
            <div class="btn-group fja-c">
                <button type="submit" class="btn-m send-all log-out" id="log-out" value="log out">log out</button>
            </div>
        </div>
    </footer>

    <script src="jsVar.js"></script>
    <script>
        let logout_btn = document.getElementById("log-out");

        logout_btn.onclick= function(){
            confirm_container[0].style.transform = "scale(1)";
            send_action_btn.innerHTML = this.value;
            send_action_btn.value = this.value;
        }
        close_alert_btn[0].onclick = function(){
            confirm_container[0].style.transform = "scale(0)";
        }
        send_action_btn.onclick = function(){
            window.location.href = 'sessionEnd.php';
        }
    </script>
</body>

</html>