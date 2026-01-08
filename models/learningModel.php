<?php
require_once('dbConnection.php');

function addLearningItem($userId, $title, $type, $totalUnits = null) {
    $conn = dbConnection();
    $title = mysqli_real_escape_string($conn, $title);
    $type = mysqli_real_escape_string($conn, $type);
    $userId = mysqli_real_escape_string($conn, $userId);
    
    $unitsVal = ($totalUnits !== null && $totalUnits > 0) ? "'".mysqli_real_escape_string($conn, $totalUnits)."'" : "NULL";
    
    $sql = "INSERT INTO learning_progress (user_id, title, type, progress, status, total_units, current_unit) VALUES ('$userId', '$title', '$type', 0, 'In Progress', $unitsVal, 0)";
    
    return mysqli_query($conn, $sql);
}

function getLearningItems($userId) {
    $conn = dbConnection();
    $userId = mysqli_real_escape_string($conn, $userId);
    
    $sql = "SELECT * FROM learning_progress WHERE user_id='$userId' ORDER BY timestamp DESC";
    $result = mysqli_query($conn, $sql);
    
    $items = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $items[] = $row;
    }
    return $items;
}

function updateProgress($itemId, $val) {
    $conn = dbConnection();
    $itemId = mysqli_real_escape_string($conn, $itemId);
    $val = (int)$val;
    
    // Check if item has total_units
    $checkSql = "SELECT total_units FROM learning_progress WHERE id='$itemId'";
    $res = mysqli_query($conn, $checkSql);
    $row = mysqli_fetch_assoc($res);
    
    if ($row && $row['total_units'] > 0) {
        $total = (int)$row['total_units'];
        $currentUnit = $val;
        if ($currentUnit > $total) $currentUnit = $total;
        
        $progress = ($currentUnit / $total) * 100;
        $progress = round($progress);
        
        $status = ($currentUnit >= $total) ? 'Completed' : 'In Progress';
        $sql = "UPDATE learning_progress SET current_unit='$currentUnit', progress='$progress', status='$status' WHERE id='$itemId'";
    } else {
        // Legacy percentage mode
        $progress = $val;
        if ($progress > 100) $progress = 100;
        $status = ($progress >= 100) ? 'Completed' : 'In Progress';
        $sql = "UPDATE learning_progress SET progress='$progress', status='$status' WHERE id='$itemId'";
    }
    
    return mysqli_query($conn, $sql);
}

function deleteLearningItem($itemId) {
    $conn = dbConnection();
    $itemId = mysqli_real_escape_string($conn, $itemId);
    
    $sql = "DELETE FROM learning_progress WHERE id='$itemId'";
    return mysqli_query($conn, $sql);
}
?>
