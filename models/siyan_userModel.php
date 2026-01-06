<?php
require_once('db.php');

function saveDocument($email, $fileName, $filePath)
{
    $con = getConnection();
    $sql = "insert into user_documents (user_email, file_name, file_path) VALUES ('$email', '$fileName', '$filePath')";
    return mysqli_query($con, $sql);
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
