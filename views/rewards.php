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
    <title>Rewards & Badges</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/menuStyle.css">
    <link rel="stylesheet" href="../assets/css/rewards.css">
</head>
<body>
    <div class="flex">
        <div class="menubar">
            <?php require_once "menubar.php"; ?>
        </div>
        <div class="container">
            <div class="welcome-header">
                <h2>Rewards & Badges</h2>
                <p>Earn points and unlock badges by using the app.</p>
            </div>
            
            <div class="rewards-container">
                <div class="points-header">
                    <div class="total-points-label">Total Points Earned</div>
                    <div class="total-points-value" id="totalPoints">0</div>
                    <div class="next-milestone" id="nextMilestone">Next Badge: Loading...</div>
                </div>
                
                <h3>Your Badges</h3>
                <div class="badges-grid" id="badgesList">

                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/shehory.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', loadRewards);
    </script>
</body>
</html>
