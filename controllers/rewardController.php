<?php
session_start();
require_once('../models/rewardModel.php');
require_once('../models/userModel.php'); 


if (!isset($_COOKIE['status'])) {
    header('HTTP/1.1 401 Unauthorized');
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$email = $_SESSION['email'];
$user = getUserInfo($email); 
$userId = $user['id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $points = getPoints($userId);
    $badges = getBadges($userId);
    

    $nextBadge = null;
    foreach ($badges as $badge) {
        if (!$badge['unlocked']) {
            $nextBadge = $badge;
            break;
        }
    }
    
    echo json_encode([
        'points' => $points,
        'badges' => $badges,
        'next_badge' => $nextBadge
    ]);
    exit();
}
?>
