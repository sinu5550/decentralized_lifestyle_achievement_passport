<?php
require_once('../models/notificationModel.php');
require_once('../models/siyan_userModel.php');
session_start();

if (!isset($_COOKIE['status'])) {
    header('location: ../views/signin.php');
    exit();
}

$email = $_SESSION['email'];
require_once('../models/userModel.php');
$user = getUserInfo($email);
$userId = $user['id'];

if (isset($_GET['mark_all_read'])) {
    markAllAsRead($userId);
    header('location: ../views/notifications.php');
    exit();
}

if (isset($_GET['mark_read'])) {
    $notifId = $_GET['mark_read'];
    markAsRead($notifId);

    if (isset($_GET['ajax'])) {
        $newCount = getUnreadCount($userId);
        echo json_encode(['success' => true, 'unreadCount' => $newCount]);
        exit();
    }

    header('location: ../views/notifications.php');
    exit();
}

header('location: ../views/notifications.php');
?>