<?php
$servername = 'localhost';
$username = 'root';
$password = "";

// create connection

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbname = "phpmail";
    try {
        $sql = "CREATE DATABASE '$dbname'";
        $conn->exec($sql);
    } catch (PDOException $s) {
        // echo "database exist";
    }
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "CREATE TABLE `userlist` (
                `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                `name` VARCHAR(30) NOT NULL,
                `mail` VARCHAR(50) NOT NULL,
                `self` VARCHAR(500) NOT NULL,
                `reg_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";

        try {
            $conn->exec($sql);
            echo "table created";
        } catch (\Throwable $th) {
            foreach ($th as $error) {
                if ($error[1] == 1050) {
                    echo "server exist";
                } else {
                    echo "<br> something strange happned.";
                }
            }
        }

        $admin_account_sql = "CREATE TABLE adminlist (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(30) NOT NULL,
                mail VARCHAR(30) NOT NULL,
                self VARCHAR(500) NOT NULL,
                pass VARCHAR(50) NOT NULL,
                admin_key VARCHAR(50) NOT NULL DEFAULT 'omni',
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
        try {
            $conn->exec($admin_account_sql);
            echo "table admin crated";
        } catch (\Throwable $th) {
            foreach ($th as $error) {
                if ($error[1] == 1050) {
                    echo "<br> server 2 exist";
                } else {
                    echo "<br> something strange 2 happned.";
                }
            }
        }


        $mail = "admin@gmail.com";
        $default_admin_sql = "INSERT INTO adminlist (name, mail, self, pass, admin_key) VALUES('admin','$mail', 'this is default account. please update it.', 'admin', '1dm1n')";
        require "functions.php";


        $check_account_exist = check_exist('adminlist', 'mail', $mail);


        if (!$check_account_exist > 0) {
            try {
                $default_admin_sql = $conn->prepare($default_admin_sql);
                $default_admin_sql->execute();
                // echo "<br> default account created: admin";
            } catch (\Throwable $th) {
                echo "<br>";
                throw $th;
            }
        } else {
            // echo "account exist";
            echo "";
        }


    } catch (PDOException $th) {
        echo $th;
    }
} catch (PDOException $e) {
    echo "connection faild " . $e->getMessage();
}

$conn = null;

header("Location: index.php");