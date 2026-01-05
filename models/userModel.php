<?php
    require_once('db.php');

    function login($user){
        $con = getConnection();
        $sql = "select * from users where email='{$user['email']}' and password='{$user['password']}'";
        $result = mysqli_query($con, $sql);
        if(mysqli_num_rows($result) == 1){
            return true;
        }else{
            return false;
        }
    }

    function addUser($user){
        $con = getConnection();
        $sql = "insert into users values(null, '{$user['fullname']}', '{$user['email']}', '{$user['password']}')";
        if(mysqli_query($con, $sql)){
            return true;
        }else{
            return false;
        }
    }

    function getUserInfo($email){
        $con = getConnection();
        $sql = "select * from users where email='{$email}'";
        $result = mysqli_query($con, $sql);
        $user = mysqli_fetch_assoc($result);
        return $user;
    }

    

?>