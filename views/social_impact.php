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
    <title>Social Impact</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/menuStyle.css">
    <link rel="stylesheet" href="../assets/css/social_impact.css">
</head>
<body>
    <div class="flex">
        <div class="menubar">
            <?php require_once "menubar.php"; ?>
        </div>
        <div class="container">
            <div class="welcome-header">
                <h2>Social Impact</h2>
                <p>Track your contributions to specific communities and society</p>
            </div>
            
            <div class="social-container">
                <div class="social-header">
                    <h2>My Impact Log</h2>
                    <button class="add-btn" onclick="openSocialModal()">+ Add Impact</button>
                </div>
                <div id="socialList" class="social-grid">
                    <!-- Loaded via JS -->
                </div>
            </div>
        </div>
    </div>

    <!-- Add Item Modal -->
    <div id="socialModal" class="modal">
        <div class="modal-content">
            <h3>Log New Impact</h3>
            <div class="form-group">
                <label>Title</label>
                <input type="text" id="socialTitle" placeholder="e.g. Community Beach Cleanup">
            </div>
            <div class="form-group">
                <label>Type</label>
                <select id="socialType">
                    <option value="Volunteering">Volunteering</option>
                    <option value="Donation">Donation</option>
                    <option value="Community Work">Community Work</option>
                    <option value="Mentorship">Mentorship</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label>Metric / Value</label>
                <input type="text" id="socialMetric" placeholder="e.g. 5 Hours, $50, 10 Trees planted">
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="date" id="socialDate">
            </div>
            <div class="form-group">
                <label>Description (Optional)</label>
                <textarea id="socialDesc" rows="3" placeholder="Brief details..."></textarea>
            </div>
            <div style="text-align: right;">
                <button class="add-btn" style="background:#ccc; color:#333" onclick="closeSocialModal()">Cancel</button>
                <button class="add-btn" onclick="submitSocialImpact()">Save Impact</button>
            </div>
        </div>
    </div>

    <script src="../assets/js/shehory.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', loadSocialImpacts);
    </script>
</body>
</html>
