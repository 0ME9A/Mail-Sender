<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">

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
            <img src="img/background3.jpg" alt="">
        </div>
    </div>
    <article class="content-container-parent fj-c">
        <div class="content-container-first-child card-container">
            <?php
            session_start();
            if (isset($_SESSION) and sizeof($_SESSION) > 0) {
                require "functions.php";
                if ($_SESSION["admin"] != '' and $_SESSION["verify"] != '') {
                    $admin_name = $_SESSION["admin"];
                    $admin_key = $_SESSION["verify"];
                    $result = check_exist_arr('adminlist', 'name', $admin_name, 'admin_key', $admin_key);
                    if (sizeof($result) == 1) {
                        require "connect.php";
                        $sql = $conn->prepare("SELECT * FROM userlist");
                        try {
                            $sql->execute();
                            $result = $sql->fetchAll();
                            foreach ($result as $row) {
                                echo '<div class="card">
                                    <div class="card-content">
                                        <div class="card-header">
                                            <h2 class="card-user">' . $row["name"] . '</h2>
                                            <a href="account.php?id=' . $row["id"] . '" class="edit icon-box"><i class="fa-solid fa-pen"></i></a>
                                        </div>
                                        <a href="mailto:' . $row["mail"] . '" class="card-mail">' . $row["mail"] . '</a>
                                        <p>' . $row["self"] . '</p>
                                        <button type="submit" class="btn-s card-btn">send</button>
                                    </div>
                                    </div>';
                            }
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                    }
                }
            } else {
                // header("Location: login.php");
                echo '<div class="card mailbot-card">
                        <div class="card-content mailbot-box">
                        <img src="img/mailBot.png" alt="" id="mailbot-img">

                        </div>
                    </div>';
            }
            $conn = null;
            ?>

        </div>
    </article>

    <footer>
        <?php
        if (isset($_SESSION) and sizeof($_SESSION) > 0) {
            if ($_SESSION["admin"] != '' and $_SESSION["verify"] != '') {
                $admin_name = $_SESSION["admin"];
                $admin_key = $_SESSION["verify"];
                $result = check_exist_arr('adminlist', 'name', $admin_name, 'admin_key', $admin_key);
                if (sizeof($result) == 1) {
                    echo '<div class="footer-containt-container">
                        <div class="btn-group fja-c">
                            <button type="submit" class="btn-m send-all update-user">send to all</button>
                        </div>
                    </div>';
                }

            }
            else{
                echo '<div class="footer-containt-container">
                    <div class="btn-group fja-c">
                        <button type="submit" class="btn-m send-all update-user" id="login-btn">log in</button>
                    </div>
                </div>';
            }
        }
        else{
            echo '<div class="footer-containt-container">
                <div class="btn-group fja-c">
                    <button type="submit" class="btn-m send-all update-user" id="login-btn">log in</button>
                </div>
            </div>';
        }
        ?>

    </footer>

    <script src="jsVar.js"></script>
    <script>
        login_btn.onclick = function(){
            window.location.href = "login.php";
        }
    </script>
</body>

</html>