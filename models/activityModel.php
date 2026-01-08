<?php
require_once('dbConnection.php');

// function logActivity moved to userModel.php to avoid conflict

function getAllActivity($userId) {
    $conn = dbConnection();
    $userId = mysqli_real_escape_string($conn, $userId);
    
    $sql = "SELECT * FROM activity_logs WHERE user_id='$userId' ORDER BY timestamp DESC";
    $result = mysqli_query($conn, $sql);
    
    $activities = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $activities[] = $row;
    }
    return $activities;
}

function clearActivityLogs($userId) {
    $conn = dbConnection();
    $userId = mysqli_real_escape_string($conn, $userId);
    
    $sql = "DELETE FROM activity_logs WHERE user_id='$userId'";
    
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}
?>
