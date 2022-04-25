<?php 
    require "functions.php";

    // existing user update or delete file account
    if ((isset($_POST["id"])) and (isset($_POST["action"]))) {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $mail = $_POST["mail"];
        $self = $_POST["self"];
        $action = $_POST["action"];

        require "connect.php";
        if ($action == "delete") {
            $sql = $conn->prepare("DELETE FROM userlist WHERE id = $id");
            try {
                $sql->execute();
                echo 0;
            } catch (\Throwable $th) {
                echo "Error: Account delete???";
            }
        }
        elseif($action == "update"){
            $sql = $conn->prepare("UPDATE userlist SET name='$name', mail='$mail', self='$self' WHERE id = $id");
            try {
                $sql->execute();
                echo 1;
            } catch (\Throwable $th) {
                echo "Error: Account update???";
            }
        }
        else{
            echo "Error: Unknown";
        }
    }


    // new user account creation with spam check file addUser
    if ($_POST["action"] == "new") {
        if ((isset($_POST["name"])) and (isset($_POST["mail"]))) {
            $name = $_POST["name"];
            $mail = $_POST["mail"];
            $self = $_POST["self"];
            $action = $_POST["action"];
    
            require "connect.php";
            $check_user_exist = check_exist('userlist', 'mail', $mail);

            if ($check_user_exist > 0) {
                echo "Error: Email address exist";
            } else {
                $sql = $conn->prepare("INSERT INTO userlist (name, mail, self) VALUES ('$name', '$mail', '$self')");
                try {
                    $sql->execute();
                    echo 1;
                } catch (\Throwable $th) {
                    echo "Error: Account can't create!!!";
                }
            }
        } else {
            echo "no data sumbited";
        }
    } 
    
    // login user and set sessions to continue suffring on web
    if (isset($_POST["action"]) and $_POST["action"] == 'login') {
        if (strlen($_POST["mail"])>4 and strlen($_POST["pass"])>4) {   
            $mail = $_POST["mail"];
            $pass = $_POST["pass"];
            $action = $_POST["action"];

            require "connect.php";
            $check_login = $conn->prepare("SELECT * FROM adminlist WHERE mail='$mail' AND BINARY pass='$pass'");
            try {
                $check_login->execute();
                $result = $check_login->fetchAll();
            } catch (\Throwable $th) {
                //throw $th;
            }
            if (sizeof($result)== 1) {
                echo 1;
                session_start();
                foreach ($result as $row) {
                    $_SESSION["admin"] = $row['name'];
                    $_SESSION["verify"] = $row['admin_key'];
                }
            }
            else{
                echo "Error: invalid email or password!!!";
            }
        }
        else{
            echo "Error: invalid email or password!!!";
        }
    }
?>