<?php
require_once('dbConnection.php');

// --- Calculation Logic ---

function calculateProfileScore($userId) {
    $conn = dbConnection();
    $userId = mysqli_real_escape_string($conn, $userId);
    
    $sql = "SELECT * FROM users WHERE id='$userId'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    
    if (!$user) return 0;
    
    $score = 0;
    $fields = ['fullName', 'email', 'phone', 'bio', 'location', 'profile_pic'];
    $maxScore = 30;
    $pointsPerField = $maxScore / count($fields);
    
    foreach ($fields as $field) {
        if (!empty($user[$field])) {
            $score += $pointsPerField;
        }
    }
    
    return round($score);
}

function calculateActivityScore($userId) {
    $conn = dbConnection();
    $userId = mysqli_real_escape_string($conn, $userId);
    
    // Count total activity logs
    $sql = "SELECT COUNT(*) as total FROM activity_logs WHERE user_id='$userId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $count = $row['total'];
    
    // Cap at 40 points (e.g., 1 point per activity, max 40)
    // Adjust logic: maybe 0.5 per activity? Let's say 1 per activity for now.
    $score = $count; 
    if ($score > 40) $score = 40;
    
    return $score;
}

function calculateFeedbackScore($userId) {
    $conn = dbConnection();
    $userId = mysqli_real_escape_string($conn, $userId);
    
    $sql = "SELECT AVG(rating) as avg_rating, COUNT(*) as count FROM feedback WHERE user_id='$userId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    $avg = $row['avg_rating'] ? $row['avg_rating'] : 0;
    $count = $row['count'];
    
    // Max 30 points.
    // Logic: Average Rating (out of 5) * 6 = 30 max.
    // But weight it by count? Let's keep it simple: Average * 6.
    
    if ($count == 0) return 0; // No feedback = 0 points
    
    $score = $avg * 6;
    if ($score > 30) $score = 30;
    
    return round($score);
}

// --- storage ---

function saveReputationScore($userId, $score, $breakdown) {
    $conn = dbConnection();
    $userId = mysqli_real_escape_string($conn, $userId);
    $score = mysqli_real_escape_string($conn, $score);
    $breakdown = mysqli_real_escape_string($conn, json_encode($breakdown));
    
    $sql = "INSERT INTO reputation_scores (user_id, score, breakdown) VALUES ('$userId', '$score', '$breakdown')";
    return mysqli_query($conn, $sql);
}

function getLatestScore($userId) {
    $conn = dbConnection();
    $userId = mysqli_real_escape_string($conn, $userId);
    
    $sql = "SELECT * FROM reputation_scores WHERE user_id='$userId' ORDER BY created_at DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

// --- Feedback Handlers ---

function addFeedback($userId, $provider, $rating, $comment) {
    $conn = dbConnection();
    $userId = mysqli_real_escape_string($conn, $userId);
    $provider = mysqli_real_escape_string($conn, $provider);
    $rating = mysqli_real_escape_string($conn, $rating);
    $comment = mysqli_real_escape_string($conn, $comment);
    
    $sql = "INSERT INTO feedback (user_id, provider_name, rating, comment) VALUES ('$userId', '$provider', '$rating', '$comment')";
    return mysqli_query($conn, $sql);
}

function getFeedbackList($userId) {
    $conn = dbConnection();
    $userId = mysqli_real_escape_string($conn, $userId);
    
    $sql = "SELECT * FROM feedback WHERE user_id='$userId' ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);
    
    $items = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $items[] = $row;
    }
    return $items;
}
?>
