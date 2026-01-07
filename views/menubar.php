<?php

if(!isset($user) && isset($_SESSION['email'])) {
require_once('../models/userModel.php');
$user = getUserInfo($_SESSION['email']);
}
if(isset($user['id'])) {
require_once('../models/notificationModel.php');
$notifCount = getUnreadCount($user['id']);
} else {
$notifCount = 0;
}
?>

<nav class="sidebar">
    <h1>LAP</h1>
    <p>Lifestyle Achievement <br />Passport</p>
    <br />
    <hr />

    <div class="mentuItems">
        <a href="../views/personalized_dashboard.php"><img src="../assets/menuImages/dashboard.png" alt=""
                class="icons" />Dashboard</a>
        <a href="../views/profilemanagement.php"><img src="../assets/menuImages/user.png" alt=""
                class="icons" />Profile</a>
        <a href="../views/goals.php"><img src="../assets/menuImages/goal.png" alt="" class="icons" />Goals</a>

        <a href="../views/challenges.php"><img src="../assets/menuImages/trophy.png" alt=""
                class="icons" />Challenges</a>
        <a href="../views/notifications.php">
            <img src="../assets/menuImages/notification.png" alt="" class="icons" />
            Notifications
            <?php if ($notifCount > 0): ?>
            <span class="menu-badge">
                <?= $notifCount ?>
            </span>
            <?php endif; ?>
        </a>
        <a href="../views/document.php"><img src="../assets/menuImages/activity.png" alt="" class="icons" />Activity
            Log</a>
        <a href="../views/time_visualization.php"><img src="../assets/menuImages/time.png" alt="" class="icons" />Time
            Visualization</a>
        <a href="../views/document.php"><img src="../assets/menuImages/book.png" alt="" class="icons" />Learning
            Progress</a>
        <a href="../views/document.php"><img src="../assets/menuImages/heart.png" alt="" class="icons" />Social
            Impact</a>
        <a href="../views/document.php"><img src="../assets/menuImages/file.png" alt="" class="icons" />Documents</a>
        <a href="../views/community.php"><img src="../assets/menuImages/community.png" alt=""
                class="icons" />Community</a>
        <a href="../views/verification.php"><img src="../assets/menuImages/checkmark.png" alt=""
                class="icons" />Verification</a>
        <a href="../views/document.php"><img src="../assets/menuImages/cv.png" alt="" class="icons" />CV
            Generator</a>
        <a href="../views/support.php"><img src="../assets/menuImages/support.png" alt="" class="icons" />Support</a>

        <div class="logout">
            <hr />
            <a href="../controllers/logout.php"><img src="../assets/menuImages/logout.png" alt="" class="icons" />
                <span style="color: red">Logout</span>
            </a>
        </div>
    </div>
</nav>