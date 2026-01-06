<?php
require_once('../controllers/authCheck.php');
require_once('../models/siyan_userModel.php');

$loggedInEmail = $_SESSION['email'];

if (isset($_GET['id'])) {
    $profileId = $_GET['id'];
    $profileUser = getUserById($profileId);

    if (!$profileUser) {
        header('location: community.php');
        exit;
    }
} else {
    header('location: community.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= htmlspecialchars($profileUser["fullName"]) ?> - Profile</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/menuStyle.css" />
</head>

<body>
    <div class="flex">
        <div class="menubar">
            <?php require_once "menubar.php"; ?>
        </div>
        <div class="container">
            <div><a href="community.php" style="color: #4834d4; text-decoration: none;"><-- Back to Community</a></div>

            <div class="flex profileScreen col-gap">
                <div>
                    <img class="profilePic" src="../assets/images/profile.PNG" alt="">
                </div>
                <div>
                    <h3><?= htmlspecialchars($profileUser["fullName"]) ?></h3>
                    <p>No bio available</p>
                    <p>✉ <?= htmlspecialchars($profileUser["email"]) ?></p>
                    <div class="flex col-gap">
                        <span>⭐ 0(0 reviews)</span><span>-</span><span>100 points</span><span>-</span><span>1 Badges</span>
                    </div>
                </div>
            </div>
            <!-- ----------------------- Badges -------------------------- -->
            <div class="badgeSection">
                <p>🏅 Badges & Achievements</p>
                <div class="badges">
                    <p>🏅</p>
                    <p>Early Bird</p>
                </div>
            </div>

            <div class="badgeSection">
                <h4>Skills & Endorsement</h4>
                <p style="margin-top: 10px;">No endorsement yet</p>
                <button class="button-blue" style="margin-top: 10px;">Endorse a Skill</button>
            </div>
            <!-- -------------------Feedback-------------------------- -->
            <?php if ($loggedInEmail !== $profileUser['email']): ?>
                <div class="badgeSection">
                    <h4>Leave Feedback</h4>
                    <p style="margin-top: 10px;">Rating</p>
                    <p>⭐⭐⭐⭐⭐</p>
                    <p style="margin-top: 10px;">Comment</p>
                    <div>
                        <textarea class="text-area" rows="8" placeholder="Share your experience with <?= htmlspecialchars($profileUser['fullName']) ?>..."></textarea>
                    </div>
                    <button class="button-blue" style="margin-top: 10px;">💬 Submit Feedback</button>
                </div>
            <?php else: ?>
                <div class="badgeSection" style="background-color: #f8f9fa; border: 1px solid #ddd;">
                    <p style="text-align: center; color: #666; padding: 10px;">
                        This is your own profile. You cannot leave feedback for yourself.
                    </p>
                </div>
            <?php endif; ?>
            <!-- --------------Community feedback------------------- -->
            <div class="badgeSection">
                <h4>Community Feedback</h4>
                <p style="margin-top: 20px; text-align: center;">No feedback yet</p>
            </div>

        </div>
    </div>

    <script src="../assets/js/script.js"></script>
</body>

</html>