<?php
    require_once('../models/userModel.php');
    
    if(isset($_POST['submit'])){
        session_start();
        
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];

        if($email == "" || $password == ""){
            echo "null email/password... please type again!";
        }else{
            $user = ['email'=> $email, 'password'=>$password];
            $status = login($user);
            
            if($status){
                setcookie('status', 'true', time()+3000, '/');
                $_SESSION['email'] = $email;
                
                $userInfo = getUserInfo($email);
                logActivity($userInfo['id'], 'User logged in');

                header('location: ../views/personalized_dashboard.php');
            }else{
                echo "Invalid email/password...";
            }
        }
    }else{
        header('location: ../views/signin.php');
    }
?>