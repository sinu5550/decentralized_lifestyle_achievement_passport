<?php
    require_once('../models/userModel.php');
    session_start();

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];

        if($email == "" || $password == "" || $confirm_password == ""){
            echo "Null value... please type again!";
        } else if(strlen($password) < 8){
            echo "Password must be at least 8 characters!";
        } else if($password != $confirm_password){
            echo "Passwords do not match!";
        } else {
            
            
            $status = resetPassword($email, $password);
            if($status){
                header('location: ../views/signin.php');
            } else {
                echo "Failed to reset password. Please try again.";
            }
        }
    } else {
        header('location: ../views/resetpassword.php');
    }
?>
