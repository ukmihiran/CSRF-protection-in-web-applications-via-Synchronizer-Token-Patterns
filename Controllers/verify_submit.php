<?php

session_start();

$msg = '';

function validateToken($token)
{
    return $token === $_SESSION['Csrf_Token']; //validate user token
}

if (isset($_POST['submit'])) {

    if (isset($_POST['Csrf_Token']) && isset($_POST['comment'])) {

        //token validation
        if (validateToken($_POST['Csrf_Token'])) {
            
            //if token is valid

            $msg = '<div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Success!</strong> Your Comment has been submitted!</div>';

        } else {
            //change the token value for effect
            echo '<div class="alert alert-danger"> CSRF Token is Invalid!</div>';
        }
    }
}
