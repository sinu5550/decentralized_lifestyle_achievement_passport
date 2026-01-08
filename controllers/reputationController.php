<?php
session_start();
require_once('../models/reputationModel.php');
require_once('../models/userModel.php'); 

// Security & Auth Check
if (!isset($_COOKIE['status'])) {
    header('HTTP/1.1 401 Unauthorized');
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$email = $_SESSION['email'];
$user = getUserInfo($email); 
$userId = $user['id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action']) && $_GET['action'] === 'history') {
        // Implementation for history if needed
    } else {
        // Get latest score
        $latest = getLatestScore($userId);
        $feedbacks = getFeedbackList($userId);
        
        echo json_encode([
            'score_data' => $latest,
            'feedbacks' => $feedbacks
        ]);
    }
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        
        if ($action === 'calculate') {
            $profileScore = calculateProfileScore($userId);
            $activityScore = calculateActivityScore($userId);
            $feedbackScore = calculateFeedbackScore($userId);
            
            $totalScore = $profileScore + $activityScore + $feedbackScore;
            if ($totalScore > 100) $totalScore = 100;
            
            $breakdown = [
                'profile' => $profileScore,
                'activity' => $activityScore,
                'feedback' => $feedbackScore
            ];
            
            if (saveReputationScore($userId, $totalScore, $breakdown)) {
                logActivity($userId, "Calculated reputation score: $totalScore");
                echo json_encode(['success' => true, 'score' => $totalScore, 'breakdown' => $breakdown]);
            } else {
                echo json_encode(['success' => false]);
            }
        } elseif ($action === 'add_feedback') {
            $provider = $_POST['provider'];
            $rating = $_POST['rating'];
            $comment = $_POST['comment'];
            
            if (addFeedback($userId, $provider, $rating, $comment)) {
                logActivity($userId, "Received feedback from $provider");
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        }
    }
    exit();
}
?>
