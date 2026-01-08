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
<?php
$feedbackList = getUserFeedback($profileId);
$avgRatingData = getUserAverageRating($profileId);
$avgRating = number_format($avgRatingData['avg_rating'], 1);
$reviewCount = $avgRatingData['count'];
?>
            <div><a href="community.php" style="color: #4834d4; text-decoration: none;"><-- Back to Community</a></div>

            <div class="flex profileScreen col-gap">
                <div>
                    <img class="profilePic" src="../assets/images/profile.PNG" alt="">
                </div>
                <div>
                    <h3><?= htmlspecialchars($profileUser["fullName"]) ?></h3>
                    <p><?= htmlspecialchars($profileUser["bio"] ?? "No bio available") ?></p>
                    <p>✉ <?= htmlspecialchars($profileUser["email"]) ?></p>
                    <div class="flex col-gap">
                        <span>⭐ <?= $avgRating ?> (<?= $reviewCount ?> reviews)</span><span>-</span><span>100 points</span><span>-</span><span>1 Badges</span>
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
                    <form action="../controllers/feedbackController.php" method="POST">
                        <input type="hidden" name="receiver_id" value="<?= $profileUser['id'] ?>">
                        <input type="hidden" id="ratingInput" name="rating" value="">
                        
                        <p style="margin-top: 10px;">Rating</p>
                        <div class="stars" style="display: flex; gap: 5px;">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <div class="star-rating" 
                                     onclick="selectRating(<?= $i ?>)" 
                                     style="cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px;"
                                     id="star-<?= $i ?>">
                                    <?= $i ?>
                                </div>
                            <?php endfor; ?>
                        </div>

                        <p style="margin-top: 10px;">Comment</p>
                        <div>
                            <textarea name="comment" class="text-area" rows="4" placeholder="Share your experience with <?= htmlspecialchars($profileUser['fullName']) ?>..."></textarea>
                        </div>
                        <button type="submit" class="button-blue" style="margin-top: 10px;">💬 Submit Feedback</button>
                    </form>
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
                <?php if (empty($feedbackList)): ?>
                    <p style="margin-top: 20px; text-align: center;">No feedback yet</p>
                <?php else: ?>
                    <?php foreach ($feedbackList as $fb): ?>
                        <div style="border-bottom: 1px solid #eee; padding: 10px 0;">
                            <div style="display: flex; justify-content: space-between;">
                                <strong><?= htmlspecialchars($fb['sender_name']) ?></strong>
                                <span>⭐ <?= $fb['rating'] ?></span>
                            </div>
                            <p style="margin-top: 5px;"><?= htmlspecialchars($fb['comment']) ?></p>
                            <small style="color: #888;"><?= date('M j, Y', strtotime($fb['created_at'])) ?></small>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <script src="../assets/js/script.js"></script>
    <script>
        function selectRating(rating) {
            document.getElementById('ratingInput').value = rating;
            
           
            for (let i = 1; i <= 5; i++) {
                let star = document.getElementById('star-' + i);
                star.style.background = 'white';
                star.style.color = 'black';
                star.style.border = '1px solid #ccc';
            }

            let selected = document.getElementById('star-' + rating);
            
            if (rating >= 4) {
                
                selected.style.background = '#ffd700'; 
                selected.style.color = '#000';
                selected.style.border = '1px solid #e6c200';
                selected.style.fontWeight = 'bold';
            } else {
                
                selected.style.background = '#e9ecef';
                selected.style.fontWeight = 'bold';
            }
        }
    </script>
</body>

</html>