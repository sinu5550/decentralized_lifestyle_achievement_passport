<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../views/signin.php");
    exit();
}
require_once('../models/userModel.php');
$user = getUserInfo($_SESSION['email']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Log</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/menuStyle.css">
    <link rel="stylesheet" href="../assets/css/activity_log.css">
</head>
<body>
    <div class="flex">
        <div class="menubar">
            <?php require_once "menubar.php"; ?>
        </div>
        <div class="container">
            <div class="welcome-header">
                <h2>Activity Log</h2>
                <p>Track your journey and actions</p>
            </div>
            
            <div class="log-container">
                <div class="log-header">
                    <h2>Recent Activities</h2>
                    <button class="clear-btn" onclick="clearLogs()">Clear History</button>
                </div>
                <div id="logList">
                    
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/shehory.js"></script>
</body>
</html>
