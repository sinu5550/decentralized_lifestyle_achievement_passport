<?php
require_once('../controllers/authCheck.php');
require_once('../models/userModel.php');
require_once('../models/goalModel.php');
require_once('../models/challengeModel.php');
 
 
$email = $_SESSION['email'];
$user = getUserInfo($email);
$userId = $user['id'];
 

$myGoals = getUserGoals($userId);
$totalGoals = count($myGoals);
$completedGoals = 0;
$totalProgress = 0;
 
foreach ($myGoals as $g) {
if ($g['status'] == 'Completed')
$completedGoals++;
$totalProgress += $g['progress'];
}
 
$avgProgress = $totalGoals > 0 ? round($totalProgress / $totalGoals) : 0;

$myChallenges = getUserChallenges($userId);
$activeChallengesCount = 0;
$totalPoints = 0;
foreach ($myChallenges as $c) {
    if ($c['status'] == 'Joined') {
        $activeChallengesCount++;
    } elseif ($c['status'] == 'Completed') {
        $totalPoints += $c['points_reward'];
    }
}

$recentActivities = getRecentActivity($userId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css" />
    <link rel="stylesheet" href="../assets/css/menuStyle.css" />
</head>

<body>
    <div class="flex">
        <div class="menubar">
            <?php require_once "menubar.php"; ?>
        </div>
        <div class="container">
            <div class="welcome-header">
                <h2>Welcome back, <?php echo $user['fullName']; ?>!</h2>
                <p>Manage your lifestyle achievements</p>
            </div>

            <section class="scoring">
                <div class="card purple-card">
                    <div class="card-text">
                        <h3>Reputation Score</h3>
                        <p>100/100</p>
                    </div>
                    <div class="card-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                            </path>
                        </svg></div>
                </div>
                <div class="card yellow-card">
                    <div class="card-text">
                        <h3>Total Points</h3>
                        <p><?= $totalPoints ?></p>
                    </div>
                    <div class="card-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 9V2h12v7"></path>
                            <path d="M5 15a2 2 0 0 1-2-2v-3c0-1.1.9-2 2-2h14a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H5z"></path>
                            <path d="M18 9v6a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V9"></path>
                            <path d="M7 22h10"></path>
                        </svg></div>
                </div>
                <div class="card blue-card">
                    <div class="card-text">
                        <h3>Active Goals</h3>
                        <p><?= $totalGoals - $completedGoals ?> (<?= $avgProgress ?>% Avg)</p>
                    </div>
                    <div class="card-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <circle cx="12" cy="12" r="6"></circle>
                            <circle cx="12" cy="12" r="2"></circle>
                        </svg></div>
                </div>
                <div class="card green-card">
                    <div class="card-text">
                        <h3>Active Challenges</h3>
                        <p><?= $activeChallengesCount ?></p>
                    </div>
                    <div class="card-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                            <polyline points="17 6 23 6 23 12"></polyline>
                        </svg></div>
                </div>
            </section>

            <section class="quickSection">
                <h3>Quick Actions</h3>
                <div class="Quick_Actions">
                    <div class="activity act-blue" onclick="window.location.href='../views/goals.php'"
                        style="cursor:pointer;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#5b4df5" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <circle cx="12" cy="12" r="2"></circle>
                        </svg>
                        <div class="act-text">
                            <h3>Create Goal</h3>
                            <p>Set new objectives</p>
                        </div>
                    </div>
                    <div class="activity act-green" onclick="window.location.href='../views/challenges.php'"
                        style="cursor:pointer;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2ecc71" stroke-width="2">
                            <path d="M6 9V2h12v7"></path>
                            <path d="M18 9v6a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V9"></path>
                        </svg>
                        <div class="act-text">
                            <h3>Take Challenge</h3>
                            <p>Join daily challenges</p>
                        </div>
                    </div>
                    <div class="activity act-purple">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#9b59b6" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                        </svg>
                        <div class="act-text">
                            <h3>Community</h3>
                            <p>View user profiles</p>
                        </div>
                    </div>
                    <div class="activity act-orange">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#e67e22" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        <div class="act-text">
                            <h3>Generate CV</h3>
                            <p>Download resume</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="recent-activity">
                <h3>Recent Activity</h3>
                <div class="activity-list">
                    <?php if (empty($recentActivities)): ?>
                    <p style="color:#888;">No recent activity found.</p>
                    <?php else: ?>
                    <?php foreach ($recentActivities as $act): ?>
                    <div class="activity-item">
                        <div class="act-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg></div>
                        <div class="act-info">
                            <span class="act-title"><?= htmlspecialchars($act['action']) ?></span>
                            <span class="act-time"><?= date("M j, Y, g:i a", strtotime($act['timestamp'])) ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </div>


    </div>
</body>

</html>