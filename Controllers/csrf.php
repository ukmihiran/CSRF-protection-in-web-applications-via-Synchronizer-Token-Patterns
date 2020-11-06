<?php

session_start();

if (isset($_POST['req_csrf'])){
    if ($_POST['req_csrf'] == $_SESSION['user_id']){
        echo $_SESSION['Csrf_Token'];
    }
}