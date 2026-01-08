<?php
session_start();
require_once('../models/siyan_userModel.php');

if (!isset($_SESSION['email'])) {
    header("location: ../views/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $senderEmail = $_SESSION['email'];
    $receiverId = $_POST['receiver_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    
    if (empty($rating) || empty($receiverId)) {
        
        header("location: ../views/communityProfile.php?id=" . $receiverId);
        exit();
    }

    $status = addFeedback($senderEmail, $receiverId, $rating, $comment);

    if ($status) {
        header("location: ../views/communityProfile.php?id=" . $receiverId);
    } else {
        echo "Error submitting feedback.";
    }
} else {
    header("location: ../views/community.php"); 
}
?>
