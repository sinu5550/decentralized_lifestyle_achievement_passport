<?php
require_once('dbConnection.php');

function addImpact($userId, $title, $type, $description, $metricValue, $date) {
    $conn = dbConnection();
    $title = mysqli_real_escape_string($conn, $title);
    $type = mysqli_real_escape_string($conn, $type);
    $description = mysqli_real_escape_string($conn, $description);
    $metricValue = mysqli_real_escape_string($conn, $metricValue);
    $date = mysqli_real_escape_string($conn, $date);
    $userId = mysqli_real_escape_string($conn, $userId);
    
    $sql = "INSERT INTO social_impact (user_id, title, type, description, metric_value, impact_date) 
            VALUES ('$userId', '$title', '$type', '$description', '$metricValue', '$date')";
    
    return mysqli_query($conn, $sql);
}

function getImpacts($userId) {
    $conn = dbConnection();
    $userId = mysqli_real_escape_string($conn, $userId);
    
    $sql = "SELECT * FROM social_impact WHERE user_id='$userId' ORDER BY impact_date DESC";
    $result = mysqli_query($conn, $sql);
    
    $items = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $items[] = $row;
    }
    return $items;
}

function deleteImpact($id) {
    $conn = dbConnection();
    $id = mysqli_real_escape_string($conn, $id);
    
    $sql = "DELETE FROM social_impact WHERE id='$id'";
    return mysqli_query($conn, $sql);
}
?>
