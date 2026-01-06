<?php
require_once('../models/db.php');
require_once('../models/userModel.php');
require_once('../models/challengeModel.php');
require_once('../controllers/authCheck.php');

$email = $_SESSION['email'];
$user = getUserInfo($email);
$userId = $user['id'];

$activeChallenges = getUserChallenges($userId);
$availableChallenges = getAvailableChallenges($userId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Challenges - LAP</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/menuStyle.css" />
    <link rel="stylesheet" href="../assets/css/challenges.css" />
</head>

<body>
    <div class="flex">
        <div class="menubar">
            <?php require_once "menubar.php"; ?>
        </div>
        <div class="container">
            <div style="width: 800px;">
                <h3>Challenges</h3>
                <p>Join challenges to earn points and build habits.</p>

               
                <div class="challenge-section">
                    <h4>My Active Challenges</h4>
                    <?php if (empty($activeChallenges)): ?>
                        <p style="color:#888; font-style:italic;">You haven't joined any challenges yet.</p>
                    <?php else: ?>
                        <div class="challenge-grid">
                            <?php foreach ($activeChallenges as $c): ?>
                                <div class="challenge-card"
                                    style="border-top-color: <?= $c['status'] == 'Completed' ? '#2ecc71' : '#f1c40f' ?>">
                                    <div>
                                        <span class="status-badge status-<?= strtolower($c['status']) ?>">
                                            <?= $c['status'] ?>
                                        </span>
                                        <h4>
                                            <?= htmlspecialchars($c['title']) ?>
                                        </h4>
                                        <p>
                                            <?= htmlspecialchars($c['description']) ?>
                                        </p>
                                    </div>
                                    <div>
                                        <div class="challenge-meta">
                                            <span>⚡
                                                <?= $c['points_reward'] ?> pts
                                            </span>
                                            <span>📅
                                                <?= $c['duration_days'] ?> days
                                            </span>
                                        </div>
                                        <?php if ($c['status'] == 'Joined'): ?>
                                            <a href="../controllers/challengeController.php?complete=<?= $c['id'] ?>"
                                                class="challenge-btn btn-complete"
                                                onclick="return confirm('Mark this challenge as complete?')">Mark Complete</a>
                                        <?php else: ?>
                                            <div style="text-align:center; color:#2ecc71; font-weight:bold;">Completed!</div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

             
                <div class="challenge-section">
                    <h4>Available Challenges</h4>
                    <div class="challenge-grid">
                        <?php foreach ($availableChallenges as $c): ?>
                            <div class="challenge-card">
                                <div>
                                    <h4>
                                        <?= htmlspecialchars($c['title']) ?>
                                    </h4>
                                    <p>
                                        <?= htmlspecialchars($c['description']) ?>
                                    </p>
                                </div>
                                <div>
                                    <div class="challenge-meta">
                                        <span>⚡
                                            <?= $c['points_reward'] ?> pts
                                        </span>
                                        <span>📅
                                            <?= $c['duration_days'] ?> days
                                        </span>
                                    </div>
                                    <a href="../controllers/challengeController.php?join=<?= $c['id'] ?>"
                                        class="challenge-btn btn-join">Join Challenge</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="../assets/js/IftyScript.js"></script>
</body>

</html>