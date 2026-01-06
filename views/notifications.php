<?php
require_once('../models/db.php');
require_once('../models/userModel.php');
require_once('../models/notificationModel.php');
require_once('../controllers/authCheck.php');

$email = $_SESSION['email'];
$user = getUserInfo($email);
$userId = $user['id'];

$notifications = getNotifications($userId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Notifications - LAP</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/menuStyle.css" />
    <link rel="stylesheet" href="../assets/css/notifications.css" />
</head>

<body>
    <div class="flex">
        <div class="menubar">
            <?php require_once "menubar.php"; ?>
        </div>
        <div class="container">
            <div class="notification-container">
                <div class="notification-header">
                    <h3>Notifications</h3>
                    <a href="../controllers/notificationController.php?mark_all_read=1" class="btn-mark-all">Mark all as
                        read</a>
                </div>

                <div class="notification-list">
                    <?php if (empty($notifications)): ?>
                        <div class="notif-card">
                            <div class="notif-content">
                                <p>No notifications yet.</p>
                            </div>
                        </div>
                    <?php else: ?>
                        <?php foreach ($notifications as $n): ?>
                            <div class="notif-card <?= $n['is_read'] ? '' : 'unread' ?> type-<?= $n['type'] ?>">
                                <div class="notif-content">
                                    <h4>
                                        <?= htmlspecialchars($n['title']) ?>
                                    </h4>
                                    <p>
                                        <?= htmlspecialchars($n['message']) ?>
                                    </p>
                                    <span class="notif-time">
                                        <?= date("M j, g:i a", strtotime($n['created_at'])) ?>
                                    </span>
                                </div>
                                <div class="notif-action">
                                    <?php if (!$n['is_read']): ?>
                                        <a href="../controllers/notificationController.php?mark_read=<?= $n['id'] ?>"
                                            title="Mark as read" onclick="markNotificationRead(event, this)">
                                            <span class="dot-unread"></span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>