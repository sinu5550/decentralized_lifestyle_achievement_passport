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
    <title>Reputation Score</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/menuStyle.css">
    <link rel="stylesheet" href="../assets/css/reputation.css">
</head>
<body>
    <div class="flex">
        <div class="menubar">
            <?php require_once "menubar.php"; ?>
        </div>
        <div class="container">
            <div class="welcome-header">
                <h2>Reputation Score</h2>
                <p>Manual calculation based on profile, activity, and feedback.</p>
            </div>
            
            <div class="reputation-container">
                <div class="score-section">
                    <div class="score-circle" id="scoreCircle">
                        <div class="score-number" id="scoreValue">0</div>
                    </div>
                    <div class="score-label">Current Reputation</div>
                    <button class="calc-btn" onclick="calculateReputation()">Calculate Score</button>
                    <p style="margin-top:10px; font-size:12px; color:#999;">Click to update based on latest data</p>
                </div>
                
                <div class="breakdown-section">
                    <h3>Score Breakdown</h3>
                    
                    <div class="breakdown-item">
                        <div class="breakdown-label">
                            <span>Profile Completeness</span>
                            <span id="profileScore">0 / 30</span>
                        </div>
                        <div class="breakdown-bar-bg">
                            <div class="breakdown-bar-fill" id="profileBar" style="width: 0%"></div>
                        </div>
                    </div>
                    
                    <div class="breakdown-item">
                        <div class="breakdown-label">
                            <span>Activity Level</span>
                            <span id="activityScore">0 / 40</span>
                        </div>
                        <div class="breakdown-bar-bg">
                            <div class="breakdown-bar-fill" id="activityBar" style="width: 0%"></div>
                        </div>
                    </div>
                    
                    <div class="breakdown-item">
                        <div class="breakdown-label">
                            <span>Received Feedback</span>
                            <span id="feedbackScore">0 / 30</span>
                        </div>
                        <div class="breakdown-bar-bg">
                            <div class="breakdown-bar-fill" id="feedbackBar" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="feedback-section">
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <h3>Received Feedback</h3>
                        <button class="calc-btn" style="width:auto; padding:5px 15px; font-size:12px; background:#2d3436;" onclick="openFeedbackModal()">+ Add Mock Feedback</button>
                    </div>
                    <div class="feedback-list" id="feedbackList">
                        <!-- Loaded via JS -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mock Feedback Modal -->
    <div id="feedbackModal" class="modal">
        <div class="modal-content">
            <h3>Add Mock Feedback</h3>
            <div class="form-group">
                <label>Provider Name</label>
                <input type="text" id="fbProvider" placeholder="e.g. John Doe">
            </div>
            <div class="form-group">
                <label>Rating (1-5)</label>
                <select id="fbRating">
                    <option value="5">5 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="2">2 Stars</option>
                    <option value="1">1 Star</option>
                </select>
            </div>
            <div class="form-group">
                <label>Comment</label>
                <textarea id="fbComment" rows="3"></textarea>
            </div>
            <div style="text-align: right;">
                <button class="add-btn" style="background:#ccc; color:#333; border:none; padding:8px 15px; border-radius:4px; cursor:pointer;" onclick="closeFeedbackModal()">Cancel</button>
                <button class="add-btn" style="background:#5b4df5; color:white; border:none; padding:8px 15px; border-radius:4px; cursor:pointer;" onclick="submitFeedback()">Add</button>
            </div>
        </div>
    </div>

    <script src="../assets/js/shehory.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', loadReputationData);
    </script>
</body>
</html>
