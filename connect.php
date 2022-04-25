<?php
    $servername = 'localhost';
    $username = 'root';
    $password = "";
    $dbname = "phpmail";

    try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\Throwable $th) {
        //throw $th;
        echo "DB Eroor: Not found";
    }
    
?>