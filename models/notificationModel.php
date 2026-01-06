<?php
require_once(__DIR__ . '/db.php');

function createNotification($userId, $title, $message, $type = 'info')
{
    $con = getConnection();
    $title = mysqli_real_escape_string($con, $title);
    $message = mysqli_real_escape_string($con, $message);

    $sql = "INSERT INTO notifications (user_id, title, message, type) VALUES ('$userId', '$title', '$message', '$type')";
    return mysqli_query($con, $sql);
}

function getNotifications($userId)
{
    $con = getConnection();
    $sql = "SELECT * FROM notifications WHERE user_id='$userId' ORDER BY created_at DESC";
    $result = mysqli_query($con, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

function getUnreadCount($userId)
{
    $con = getConnection();
    $sql = "SELECT COUNT(*) as count FROM notifications WHERE user_id='$userId' AND is_read=0";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}

function markAsRead($notificationId)
{
    $con = getConnection();
    $sql = "UPDATE notifications SET is_read=1 WHERE id='$notificationId'";
    return mysqli_query($con, $sql);
}

function markAllAsRead($userId)
{
    $con = getConnection();
    $sql = "UPDATE notifications SET is_read=1 WHERE user_id='$userId'";
    return mysqli_query($con, $sql);
}
?>