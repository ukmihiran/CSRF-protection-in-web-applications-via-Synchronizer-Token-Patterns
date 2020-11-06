<?php
//Session start
session_start();
//DB connection
require_once('Config/Connection.php');

//error message variable
$error = '';

//check form submission
if (isset($_POST['login'])){

    //check if username and password has been entered
    if (!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1){
        $error = '<div class="alert alert-danger"> Username Invalid!</div>';

    }
    if (!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1){
        $error = '<div class="alert alert-danger"> Password Invalid!</div>';

    }
        //check error free
    if (empty($error)){

        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $hashPwd = sha1($password); //load sha1 hash password

        $query = "SELECT * FROM users WHERE email= '{$email}' AND password= '{$hashPwd}' LIMIT 1";

        $result = mysqli_query($connection, $query);

        if ($result){

            if (mysqli_num_rows($result) == 1){

                //create session
                $user = mysqli_fetch_assoc($result);
                $_SESSION['user_id'] = $user['id'];

                //genearte token
                if (empty($_SESSION['Csrf_Token'])) {
                    $_SESSION['Csrf_Token'] = bin2hex(random_bytes(32));
                }
                //redirect to home.php
                header("Location: home.php");

            } else{
                //user name and password invalid
                $error = '<div class="alert alert-warning"> Username or Password Invalid!</div>';

            }
        } else {
            $error = '<div class="alert alert-danger"> Database connection Lost!</div>';
        }
    }
}

?>