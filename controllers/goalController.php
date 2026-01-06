<?php
require_once('../models/goalModel.php');
require_once('../models/siyan_userModel.php');
session_start();

if (!isset($_COOKIE['status'])) {
    header('location: ../views/signin.php');
    exit();
}

$email = $_SESSION['email'];
require_once('../models/userModel.php');
$user = getUserInfo($email);
$userId = $user['id'];

if (isset($_POST['create_goal'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];

    if (empty($title) || empty($deadline)) {
        header('location: ../views/goals.php?error=empty_fields');
    } else {
        $goalData = [
            'title' => $title,
            'description' => $description,
            'deadline' => $deadline
        ];

        if (createGoal($userId, $goalData)) {
            header('location: ../views/goals.php?success=created');
        } else {
            header('location: ../views/goals.php?error=db_error');
        }
    }
} elseif (isset($_POST['add_milestone'])) {
    $goalId = $_POST['goal_id'];
    $title = $_POST['milestone_title'];

    if (!empty($title)) {
        addMilestone($goalId, $title);
    }
    header('location: ../views/goals.php');

} elseif (isset($_GET['toggle_milestone'])) {
    $milestoneId = $_GET['toggle_milestone'];
    toggleMilestone($milestoneId);
    header('location: ../views/goals.php');

} elseif (isset($_GET['delete_milestone'])) {
    $milestoneId = $_GET['delete_milestone'];
    deleteMilestone($milestoneId);
    header('location: ../views/goals.php');

} elseif (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if (deleteGoal($id)) {
        header('location: ../views/goals.php?success=deleted');
    } else {
        header('location: ../views/goals.php?error=delete_failed');
    }
} else {
    header('location: ../views/goals.php');
}
?>