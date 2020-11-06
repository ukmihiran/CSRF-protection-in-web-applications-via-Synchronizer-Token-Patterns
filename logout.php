<?php     
    session_start();
    session_destroy();
    unset($_COOKIE['Csrf_Token']);

    header("Location: index.php")
?>