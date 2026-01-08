<?php
require_once('../models/userModel.php');
require_once('../models/diaryModel.php');
session_start();

if (!isset($_SESSION['email'])) {
    header('location: ../views/signin.php');
    exit();
}

$currentUser = getUserInfo($_SESSION['email']);

if (isset($_POST['add_entry'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (addEntry($currentUser['id'], $title, $content)) {
        header('location: ../views/diary.php');
    } else {
        echo "Error adding entry";
    }
} elseif (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    if (deleteEntry($id, $currentUser['id'])) {
        header('location: ../views/diary.php');
    } else {
        echo "Error deleting entry";
    }
} else {
    header('location: ../views/diary.php');
}
?>