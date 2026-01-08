<?php
session_start();
require_once('../models/activityModel.php');

// Security & Auth Check
if (!isset($_COOKIE['status'])) {
    header('HTTP/1.1 401 Unauthorized');
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$email = $_SESSION['email'];
require_once('../models/userModel.php');
// Using getUserInfo from userModel to get ID from session email
$user = getUserInfo($email); 
$userId = $user['id'];

// Handle GET request to fetch logs
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $activities = getAllActivity($userId);
    echo json_encode($activities);
    exit();
}

// Handle POST request to clear logs
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check for "action" parameter
    if (isset($_POST['action']) && $_POST['action'] === 'clear_logs') {
        if (clearActivityLogs($userId)) {
            echo json_encode(['success' => true, 'message' => 'Logs cleared successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to clear logs']);
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'log_action') {
        $description = $_POST['description'] ?? 'Performed an action';
        if (logActivity($userId, $description)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['error' => 'Invalid action']);
    }
    exit();
}
?>
