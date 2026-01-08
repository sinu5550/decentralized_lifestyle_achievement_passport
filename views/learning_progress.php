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
    <title>Learning Progress</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/menuStyle.css">
    <link rel="stylesheet" href="../assets/css/learning_progress.css">
</head>
<body>
    <div class="flex">
        <div class="menubar">
            <?php require_once "menubar.php"; ?>
        </div>
        <div class="container">
            <div class="welcome-header">
                <h2>Learning Progress</h2>
                <p>Track your courses, books, and skills</p>
            </div>
            
            <div class="learning-container">
                <div class="learning-header">
                    <h2>My Learning List</h2>
                    <button class="add-btn" onclick="openAddModal()">+ Add New</button>
                </div>
                <div id="learningList" class="learning-grid">
                    <!-- Loaded via JS -->
                </div>
            </div>
        </div>
    </div>

    <!-- Add Item Modal -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <h3>Add New Learning Item</h3>
            <div class="form-group">
                <label>Title</label>
                <input type="text" id="learnTitle" placeholder="e.g. Advanced PHP">
            </div>
            <div class="form-group">
                <label>Type</label>
                <select id="learnType">
                    <option value="Course">Course</option>
                    <option value="Book">Book</option>
                    <option value="Skill">Skill</option>
                </select>
            </div>
            <div class="form-group">
                <label>Total Units (optional)</label>
                <input type="number" id="learnTotalUnits" placeholder="e.g. Total Chapters, Pages, or Hours">
                <small style="color:#666; font-size:12px;">Leave empty to track by percentage (0-100%)</small>
            </div>
            <div style="text-align: right;">
                <button class="add-btn" style="background:#ccc; color:#333" onclick="closeAddModal()">Cancel</button>
                <button class="add-btn" onclick="submitLearningItem()">Add</button>
            </div>
        </div>
    </div>

    <script src="../assets/js/shehory.js"></script>
    <script>
        // Init learning specific logic if needed on load, or call from shehory.js
        document.addEventListener('DOMContentLoaded', loadLearningItems);
    </script>
</body>
</html>
