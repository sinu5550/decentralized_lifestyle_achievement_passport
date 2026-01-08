<?php
session_start();
require_once('../models/socialModel.php');
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
    $items = getImpacts($userId);
    echo json_encode($items);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        
        if ($action === 'add') {
            $title = $_POST['title'];
            $type = $_POST['type'];
            $description = $_POST['description'];
            $metricValue = $_POST['metric_value'];
            $date = $_POST['date'];
            
            if (addImpact($userId, $title, $type, $description, $metricValue, $date)) {
                logActivity($userId, "Added social impact: $title ($type)");
                addPoints($userId, 15);
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        } elseif ($action === 'delete') {
            $id = $_POST['id'];
            if (deleteImpact($id)) {
                logActivity($userId, "Deleted social impact");
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        }
    }
    exit();
}
?>
