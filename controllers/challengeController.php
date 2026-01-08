<?php
require_once('../models/challengeModel.php');
require_once('../models/notificationModel.php');
require_once('../models/siyan_userModel.php');
require_once('../models/rewardModel.php');
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
        logActivity($userId, "Joined a challenge");
        createNotification($userId, 'Challenge Joined', 'You joined a new challenge. Good luck!', 'info');

        if (isset($_GET['ajax'])) {
            echo json_encode(['success' => true, 'action' => 'joined']);
            exit();
        }

        header('location: ../views/challenges.php?success=joined');
    } else {
        if (isset($_GET['ajax'])) {
            echo json_encode(['success' => false, 'error' => 'already_joined']);
            exit();
        }
        header('location: ../views/challenges.php?error=already_joined');
    }
} elseif (isset($_GET['complete'])) {
    $userChallengeId = $_GET['complete'];

    if (completeChallenge($userId, $userChallengeId)) {
        logActivity($userId, "Completed a challenge");
        addPoints($userId, 50);
        createNotification($userId, 'Challenge Completed', 'Congratulations! You completed a challenge.', 'success');

        if (isset($_GET['ajax'])) {
            echo json_encode(['success' => true, 'action' => 'completed']);
            exit();
        }

        header('location: ../views/challenges.php?success=completed');
    } else {
        if (isset($_GET['ajax'])) {
            echo json_encode(['success' => false, 'error' => 'failed']);
            exit();
        }
        header('location: ../views/challenges.php?error=failed');
    }
} else {
    header('location: ../views/challenges.php');
}
?>