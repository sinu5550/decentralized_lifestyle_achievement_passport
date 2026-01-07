<?php
require_once('db.php');

function login($user)
{
    $con = getConnection();
    $sql = "select * from users where email='{$user['email']}' and password='{$user['password']}'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) == 1) {
        return true;
    } else {
        return false;
    }
}

function addUser($user)
{
    $con = getConnection();
    $sql = "insert into users values(null, '{$user['fullname']}', '{$user['email']}', '{$user['password']}')";
    if (mysqli_query($con, $sql)) {
        return true;
    } else {
        return false;
    }
}

function getUserInfo($email)
{
    $con = getConnection();
    $sql = "select * from users where email='{$email}'";
    $result = mysqli_query($con, $sql);
    $user = mysqli_fetch_assoc($result);
    return $user;
}



function updateUser($userId, $data)
{
    $con = getConnection();
    $fullName = $data['fullName'];
    $email = $data['email'];
    $phone = $data['phone'];
    $bio = $data['bio'];
    $location = $data['location'];
    
    $picUpdate = "";
    if (isset($data['profile_pic']) && !empty($data['profile_pic'])) {
        $pic = $data['profile_pic'];
        $picUpdate = ", profile_pic='$pic'";
    }

    $sql = "UPDATE users SET fullName='$fullName', email='$email', phone='$phone', bio='$bio', location='$location' $picUpdate WHERE id='$userId'";
    
    if (mysqli_query($con, $sql)) {
        return true;
    } else {
        return false;
    }
}


function logActivity($userId, $action)
{
    $con = getConnection();
    $action = mysqli_real_escape_string($con, $action);
    $sql = "INSERT INTO activity_logs (user_id, action) VALUES ('$userId', '$action')";
    return mysqli_query($con, $sql);
}

function getRecentActivity($userId, $limit = 5)
{
    $con = getConnection();
    $sql = "SELECT * FROM activity_logs WHERE user_id='$userId' ORDER BY timestamp DESC LIMIT $limit";
    $result = mysqli_query($con, $sql);
    $activities = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $activities[] = $row;
    }
    return $activities;
}
?>
