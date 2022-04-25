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
        form{
            width: 400px;
            display: none;
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
    <article class="content-container-parent fj-c">
        <div class="content-container-first-child card-container">
            <div class="card">
                <?php
                    include "connect.php";
                    if (isset($_GET["id"]) and $_GET["id"]!= '') {
                        $id = $_GET["id"];
                        $sql = $conn->prepare("SELECT * FROM userlist WHERE id='$id'");
                        try {
                            $sql->execute();
                            $result = $sql->fetchAll();
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                        try {
                            foreach ($result as $row) {
                                echo  '<div class="card-content">
                                <div class="card-header">
                                <h2 class="card-user" contenteditable="true" id="'.$row["id"].'">'.$row["name"].'</h2>
                                </div>
                                <a class="card-mail" contenteditable="true">'.$row["mail"].'</a>
                                <p contenteditable="true" class="card-self">'.$row["self"].'</p>
                                </div>';
                            }
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                    }
                    else{
                        echo  '<div class="card-content">
                        <div class="card-header">
                        <h2 class="card-user">Account not found</h2>
                        </div>
                        </div>';
                    }
                    $conn=null;
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
            <?php 
                if (isset($_GET["id"]) and $_GET["id"]!= '') {
                    echo '<div class="btn-group fja-c">
                    <button type="submit" class="btn-m send-all delete-user" value="delete">delete</button>
                    <button type="submit" class="btn-m send-all update-user" value="update">update</button>
                </div>';
                }    
            ?>

        </div>
    </footer>


    <script src="jsVar.js"></script>
    <script>
        const up_del = new Array(delete_user[0], update_user[0]);
        const card_query = new Array(card_user[0], card_mail[0], card_self[0]);
        

        let u_name= '';
        let u_mail= '';
        let u_self= '';
        let u_id ='';
        let u_action = '';
        

        for (let i = 0; i < up_del.length; i++) {
            const element = up_del[i];
            element.onclick = function(){
                confirm_container[0].style.transform="scale(1)";
                u_name = card_query[0].innerText;
                u_mail = card_query[1].innerText;
                u_self = card_query[2].innerText;
                u_id = card_query[0].id;
                u_action = this.value;
                send_action.innerText = this.value

                if (this.value == 'delete') {
                    send_action.style.background = 'red';
                }
                else{
                    send_action.style.background = 'green';
                }
            }
        }


        // ajax send data start------------------




        function Show_info(id, name, mail, self, action) {
            if (id == ""|| action==""){
                return;
            }
            else{
                var xmlhtpp = new XMLHttpRequest();
                xmlhtpp.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200){
                        alert_parent[0].style.opacity = 1;
                        console.log(this.responseText);
                        if (this.responseText == 1) {
                            alert_tag[0].innerHTML = "Account updated";
                            alert_tag[0].style.color = "green";
                            confirm_container[0].style.transform="scale(0)";
                        }
                        else if (this.responseText == 0){
                            alert_tag[0].innerHTML = "Account deleted";
                            alert_tag[0].style.color = "red";
                            confirm_container[0].style.transform="scale(0)";
                            setTimeout(() => {
                                window.location.href = "index.php";
                            }, 1000);
                        }
                        else{
                            alert_tag[0].innerHTML = "Error: Unknown";
                            alert_tag[0].style.color = "red";
                            confirm_container[0].style.transform="scale(0)";
                        }
                    } 
                }
                xmlhtpp.open("POST","serverToClient.php", true);
                xmlhtpp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhtpp.send("id="+id+"&name="+name+"&mail="+mail+"&self="+self+"&action="+action);
            }    
        }

        
        send_action_btn.onclick = function(){
            Show_info(u_id, u_name, u_mail, u_self, u_action);
        }


        // ajax send data end---------------------


        close_alert_btn[0].onclick = function(){
            confirm_container[0].style.transform="scale(0)";
        }
    </script>
</body>

</html>