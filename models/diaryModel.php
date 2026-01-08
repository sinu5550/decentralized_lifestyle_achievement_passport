<?php
require_once('db.php');

function addEntry($userId, $title, $content)
{
    $con = getConnection();
    $userId = mysqli_real_escape_string($con, $userId);
    $title = mysqli_real_escape_string($con, $title);
    $content = mysqli_real_escape_string($con, $content);

    $sql = "INSERT INTO diary (user_id, title, content) VALUES ('$userId', '$title', '$content')";
    return mysqli_query($con, $sql);
}

function getEntries($userId)
{
    $con = getConnection();
    $userId = mysqli_real_escape_string($con, $userId);
    $sql = "SELECT * FROM diary WHERE user_id = '$userId' ORDER BY created_at DESC";
    $result = mysqli_query($con, $sql);
    $entries = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $entries[] = $row;
    }
    return $entries;
}

function deleteEntry($entryId, $userId)
{
    $con = getConnection();
    $entryId = mysqli_real_escape_string($con, $entryId);
    $userId = mysqli_real_escape_string($con, $userId);

    $sql = "DELETE FROM diary WHERE id = '$entryId' AND user_id = '$userId'";
    return mysqli_query($con, $sql);
}
?>