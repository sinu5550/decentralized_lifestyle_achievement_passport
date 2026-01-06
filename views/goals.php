<?php
require_once('../models/db.php');
require_once('../models/userModel.php');
require_once('../models/goalModel.php');
require_once('../controllers/authCheck.php');

$email = $_SESSION['email'];
$user = getUserInfo($email);
$userId = $user['id'];
$myGoals = getUserGoals($userId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Goals - LAP</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/menuStyle.css" />
    <link rel="stylesheet" href="../assets/css/goals.css" />

</head>

<body>
    <div class="flex">
        <div class="menubar">
            <?php require_once "menubar.php"; ?>
        </div>
        <div class="container">
            <div style="width: 800px;">
                <h3>My Goals</h3>
                <p>Set, track, and achieve your aspirations</p>

                <!-- Create Goal Section -->
                <div class="create-goal-form">
                    <h4>Create New Goal</h4>
                    <form action="../controllers/goalController.php" method="POST">
                        <div class="form-group">
                            <label>Goal Title</label>
                            <input type="text" name="title" required placeholder="e.g. Learn React Native">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" rows="3" placeholder="Details about your goal..."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Deadline</label>
                            <input type="date" name="deadline" required>
                        </div>
                        <button type="submit" name="create_goal" class="btn btn-primary">Add Goal</button>
                    </form>
                </div>

                <!-- Goals List -->
                <div class="goals-list">
                    <?php if (empty($myGoals)): ?>
                        <p>No goals set yet. Start by creating one!</p>
                    <?php else: ?>
                        <?php foreach ($myGoals as $goal): ?>
                            <div class="goal-card <?= $goal['status'] == 'Completed' ? 'completed' : '' ?>">
                                <div class="goal-header">
                                    <h3><?= htmlspecialchars($goal['title']) ?></h3>
                                    <span style="font-size: 0.9em; color: #666;"><?= $goal['status'] ?></span>
                                </div>
                                <p><?= htmlspecialchars($goal['description']) ?></p>
                                <p style="font-size: 0.9em; color: #888; margin-top: 5px;">Deadline: <?= $goal['deadline'] ?></p>

                                <div class="progress-bar-bg">
                                    <div class="progress-bar-fill" style="width: <?= $goal['progress'] ?>%"></div>
                                </div>
                                <p style="text-align: right; font-size: 0.8em; margin-top: 5px;"><?= $goal['progress'] ?>% Completed</p>
                                
                                <!-- Milestones -->
                                <div class="milestones-section">
                                    <strong>Milestones</strong>
                                    <?php if (!empty($goal['milestones'])): ?>
                                        <?php foreach ($goal['milestones'] as $ms): ?>
                                            <div class="milestone-item <?= $ms['is_completed'] ? 'done' : '' ?>">
                                                <div style="display:flex; align-items:center; gap:8px;">
                                                    <a href="../controllers/goalController.php?toggle_milestone=<?= $ms['id'] ?>" 
                                                       style="text-decoration:none; color:inherit; display:flex; align-items:center;">
                                                        <?php if ($ms['is_completed']): ?>
                                                            <img src="../assets/menuImages/checkmark.png" width="16" alt="Done">
                                                        <?php else: ?>
                                                            <span style="display:inline-block; width:14px; height:14px; border:1px solid #777; border-radius:3px;"></span>
                                                        <?php endif; ?>
                                                    </a>
                                                    <span><?= htmlspecialchars($ms['title']) ?></span>
                                                </div>
                                                <a href="../controllers/goalController.php?delete_milestone=<?= $ms['id'] ?>" class="delete-ms">×</a>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                    <!-- Add Milestone Form -->
                                    <form action="../controllers/goalController.php" method="POST" class="add-milestone-form">
                                        <input type="hidden" name="goal_id" value="<?= $goal['id'] ?>">
                                        <input type="text" name="milestone_title" placeholder="Add a milestone (e.g. Month 1, Week 1)" required>
                                        <button type="submit" name="add_milestone">+</button>
                                    </form>
                                </div>


                                <div class="goal-actions">
                                    <!-- Only Delete Needed for Goal itself now -->
                                    <a href="../controllers/goalController.php?delete=<?= $goal['id'] ?>" class="btn btn-danger"
                                        style="padding: 5px 10px; font-size: 0.8em; text-decoration: none;"
                                        onclick="return confirmDelete('Are you sure you want to delete this goal?')">Delete Goal</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/IftyScript.js"></script>
</body>
</html>