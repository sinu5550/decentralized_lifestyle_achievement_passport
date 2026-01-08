<?php
require_once('db.php');

function saveDocument($email, $fileName, $filePath)
{
    $con = getConnection();
    $sql = "insert into user_documents (user_email, file_name, file_path) VALUES ('$email', '$fileName', '$filePath')";
    if(mysqli_query($con, $sql)){
        return mysqli_insert_id($con);
    }
    return false;
}

function getUserDocuments($email)
{
    $con = getConnection();
    $sql = "select * from user_documents WHERE user_email = '$email' ORDER BY id DESC";
    $result = mysqli_query($con, $sql);
    $docs = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $docs[] = $row;
    }
    return $docs;
}

function getAllUsers()
{
    $con = getConnection();
    $sql = "select * from users";
    $result = mysqli_query($con, $sql);
    $users = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    return $users;
}

function getUserById($id)
{
    $con = getConnection();
    $sql = "select * from users where id='{$id}'";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}

function getUserFeedback($userId)
{
    $con = getConnection();
    $sql = "SELECT f.*, u.fullName as sender_name 
            FROM user_feedback f 
            JOIN users u ON f.sender_email = u.email 
            WHERE f.receiver_id = '$userId' 
            ORDER BY f.created_at DESC";
    $result = mysqli_query($con, $sql);
    $feedback = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $feedback[] = $row;
    }
    return $feedback;
}

function getUserAverageRating($userId)
{
    $con = getConnection();
    $sql = "SELECT AVG(rating) as avg_rating, COUNT(*) as count 
            FROM user_feedback 
            WHERE receiver_id = '$userId'";
    $result = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($result);
    
    if (!$data['avg_rating']) {
        $data['avg_rating'] = 0;
    }
    return $data;
}

function addFeedback($senderEmail, $receiverId, $rating, $comment)
{
    $con = getConnection();
    
    $comment = addslashes($comment);

    $sql = "INSERT INTO user_feedback (sender_email, receiver_id, rating, comment) 
            VALUES ('$senderEmail', '$receiverId', '$rating', '$comment')";
    
    return mysqli_query($con, $sql);
}

function getDocumentById($id)
{
    $con = getConnection();
    $sql = "select * from user_documents where id='{$id}'";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}

function deleteDocument($id)
{
    $con = getConnection();
    $sql = "delete from user_documents where id='{$id}'";
    return mysqli_query($con, $sql);
}

function saveVerificationDocument($email, $fileName, $filePath)
{
    $con = getConnection();
    $sql = "insert into verification_documents (user_email, file_name, file_path, status) VALUES ('$email', '$fileName', '$filePath', 'pending')";
    if(mysqli_query($con, $sql)){
        return mysqli_insert_id($con);
    }
    return false;
}

function getVerificationDocuments($email)
{
    $con = getConnection();
    $sql = "select * from verification_documents WHERE user_email = '$email' ORDER BY id DESC";
    $result = mysqli_query($con, $sql);
    $docs = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $docs[] = $row;
    }
    return $docs;
}

function verifyDocument($id)
{
    $con = getConnection();
    $sql = "UPDATE verification_documents SET status = 'verified' WHERE id = '$id'";
    return mysqli_query($con, $sql);
}
