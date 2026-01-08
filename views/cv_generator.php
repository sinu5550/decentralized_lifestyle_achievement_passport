<?php
require_once('../models/db.php');
require_once('../models/userModel.php');
require_once('../controllers/authCheck.php');

$email = $_SESSION['email'];
$user = getUserInfo($email);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Generator - LAP</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/menuStyle.css">
    <link rel="stylesheet" href="../assets/css/cv.css">
</head>

<body>
    <div class="flex">
        <div class="menubar">
            <?php require_once "menubar.php"; ?>
        </div>
        <div class="container">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                <h3>CV Generator</h3>
                <button onclick="logAndPrint()" class="button-blue btn-print-action"
                    style="padding:10px 20px;">Download PDF / Print</button>
            </div>

            <div class="cv-container">
               
                <div class="cv-form">
                    <h3>Your Details</h3>
                    <form id="cvForm" onkeyup="updateCV()">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" id="inpName" placeholder="John Doe"
                                value="<?= htmlspecialchars($user['fullName']) ?>">
                        </div>
                        <div class="form-group">
                            <label>Job Title</label>
                            <input type="text" id="inpTitle" placeholder="Software Engineer">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" id="inpEmail" value="<?= htmlspecialchars($user['email']) ?>">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" id="inpPhone" placeholder="+1 234 567 890">
                        </div>
                        <div class="form-group">
                            <label>Professional Summary</label>
                            <textarea id="inpSummary" placeholder="Brief overview of your career..."></textarea>
                        </div>

                        <hr style="margin:20px 0; border:0; border-top:1px solid #eee;">

                        <h4>Experience</h4>
                        <div id="exp-container">
                            <div class="form-group">
                                <input type="text" class="exp-role" placeholder="Role (e.g. Developer)"
                                    style="margin-bottom:5px;">
                                <input type="text" class="exp-company" placeholder="Company" style="margin-bottom:5px;">
                                <textarea class="exp-desc" placeholder="Responsibilities..."
                                    style="height:60px;"></textarea>
                            </div>
                        </div>
                        <button type="button" class="btn-add" onclick="addExperienceField()">+ Add More
                            Experience</button>

                        <hr style="margin:20px 0; border:0; border-top:1px solid #eee;">

                        <h4>Education</h4>
                        <div id="edu-container">
                            <div class="form-group">
                                <input type="text" class="edu-degree" placeholder="Degree (e.g. BSc CS)"
                                    style="margin-bottom:5px;">
                                <input type="text" class="edu-school" placeholder="School / University">
                            </div>
                        </div>
                        <button type="button" class="btn-add" onclick="addEducationField()">+ Add More
                            Education</button>

                        <hr style="margin:20px 0; border:0; border-top:1px solid #eee;">

                        <h4>Skills</h4>
                        <div class="form-group">
                            <label>Skills (comma separated)</label>
                            <textarea id="inpSkills" placeholder="PHP, JavaScript, HTML, CSS..."></textarea>
                        </div>
                    </form>
                </div>

              
                <div class="cv-preview">
                    <div id="cv-template">
                        <h1 id="cvName">Your Name</h1>
                        <div class="cv-contact">
                            <span id="cvTitle">Job Title</span> |
                            <span id="cvEmail">email@example.com</span> |
                            <span id="cvPhone">Phone</span>
                        </div>

                        <h2>Professional Summary</h2>
                        <p id="cvSummary">Your professional summary will appear here.</p>

                        <h2>Experience</h2>
                        <div id="cvExperience">
                         </div>

                        <h2>Education</h2>
                        <div id="cvEducation">
                            </div>

                        <h2>Skills</h2>
                        <div id="cvSkills" class="cv-skills-list">
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/IftyScript.js"></script>
    <script>
        function logAndPrint() {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../controllers/activityController.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('action=log_action&description=Generated CV');
            
            // Allow small delay or just print (print usually blocks, so request might be pending until after or sent immediately)
            // setTimeout ensures the async send has a moment, though browser might handle it.
            setTimeout(function() {
                window.print();
            }, 500);
        }
      
        updateCV();
    </script>
</body>

</html>