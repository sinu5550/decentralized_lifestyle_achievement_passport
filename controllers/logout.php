<?php
session_start();
require_once('../models/userModel.php');

if(isset($_SESSION['email'])) {
    $user = getUserInfo($_SESSION['email']);
    if($user) {
        logActivity($user['id'], 'User logged out');
    }
    session_destroy();
}

setcookie('status', 'true', time() - 10, '/');
header('location: ../views/signin.php');
?>