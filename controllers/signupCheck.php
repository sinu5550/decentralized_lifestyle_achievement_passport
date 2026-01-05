<?php
    require_once('../models/userModel.php');
    
    if(isset($_POST['submit'])){
        session_start();

        $fname    = $_REQUEST['First_Name'];
        $lname    = $_REQUEST['Last_Name'];
        $email    = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $confirmP = $_REQUEST['confirmPassword'];

        if($fname == "" || $lname == "" || $email == "" || $password == ""){
            echo "Null submission... please fill all fields!";
        } elseif($password !== $confirmP) {
            echo "Passwords do not match!";
        } else {
            $fullname = $fname . " " . $lname;
            
            $user = [
                'fullname' => $fullname, 
                'email'    => $email,
                'password' => $password 
            ];

            $status = addUser($user);

            if($status){
                header('location: ../views/signin.php');
            }else{
                header('location: ../views/signup.php');
            }
        }
    } else {
        header('location: ../views/signup.php');
    }
?>