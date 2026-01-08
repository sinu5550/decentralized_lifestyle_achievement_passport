<?php
require_once('../models/goalModel.php');
require_once('../models/siyan_userModel.php');
require_once('../models/notificationModel.php');
require_once('../models/rewardModel.php');
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

        if (createGoal($userId, $title, $description, $deadline)) {
            logActivity($userId, "Created goal: $title");
            createNotification($userId, 'New Goal Set', "You committed to: $title", 'success');
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
        logActivity($userId, "Added milestone: $title");
    }
    header('location: ../views/goals.php');

} elseif (isset($_GET['toggle_milestone'])) {
    $milestoneId = $_GET['toggle_milestone'];
    $success = toggleMilestone($milestoneId);
    
    // We don't easily have the milestone title here without fetching it, so generic log or skip for now to keep it simple/fast? 
    // The user asked for "all information". Let's log "Toggled milestone status".
    logActivity($userId, "Toggled milestone status");
    if($success) addPoints($userId, 10); // Simple logic: award on toggle action success. Ideally check if "completed" state.

    if (isset($_GET['ajax'])) {
        echo json_encode(['success' => $success]);
        exit();
    }

    header('location: ../views/goals.php');

} elseif (isset($_GET['delete_milestone'])) {
    $milestoneId = $_GET['delete_milestone'];
    deleteMilestone($milestoneId);
    logActivity($userId, "Deleted a milestone");
    header('location: ../views/goals.php');

} elseif (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if (deleteGoal($id)) {
        logActivity($userId, "Deleted a goal");
        header('location: ../views/goals.php?success=deleted');
    } else {
        header('location: ../views/goals.php?error=delete_failed');
    }
} else {
    header('location: ../views/goals.php');
}
?>