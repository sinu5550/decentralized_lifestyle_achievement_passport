<?php
session_start();
require_once('../models/learningModel.php');
require_once('../models/userModel.php'); 
require_once('../models/rewardModel.php'); 

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
    $items = getLearningItems($userId);
    echo json_encode($items);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        
        if ($action === 'add') {
            $title = $_POST['title'];
            $type = $_POST['type'];
            $totalUnits = isset($_POST['total_units']) ? $_POST['total_units'] : null;
            if (addLearningItem($userId, $title, $type, $totalUnits)) {
                $unitMsg = $totalUnits ? " ($totalUnits units)" : "";
                logActivity($userId, "Started learning: $title ($type)$unitMsg");
                addPoints($userId, 5);
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        } elseif ($action === 'update_progress') {
            $id = $_POST['id'];
            $progress = $_POST['progress'];
            if (updateProgress($id, $progress)) {
                logActivity($userId, "Updated learning progress");
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        } elseif ($action === 'delete') {
            $id = $_POST['id'];
            if (deleteLearningItem($id)) {
                logActivity($userId, "Deleted learning item");
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        }
    }
    exit();
}
?>
