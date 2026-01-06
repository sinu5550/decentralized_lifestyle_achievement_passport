<?php
require_once('../models/challengeModel.php');
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

if (isset($_GET['join'])) {
    $challengeId = $_GET['join'];
    if (joinChallenge($userId, $challengeId)) {
        header('location: ../views/challenges.php?success=joined');
    } else {
        header('location: ../views/challenges.php?error=already_joined');
    }
} elseif (isset($_GET['complete'])) {
    $userChallengeId = $_GET['complete'];

    if (completeChallenge($userId, $userChallengeId)) {
        header('location: ../views/challenges.php?success=completed');
    } else {
        header('location: ../views/challenges.php?error=failed');
    }
} else {
    header('location: ../views/challenges.php');
}
?>