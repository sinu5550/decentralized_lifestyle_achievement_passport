<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
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
            <!-- profile------------------- -->
            <div class="flex profileScreen col-gap">
                <div>
                    <img class="profilePic" src="../assets/images/profile.PNG" alt="">
                </div>
                <div>
                    <h3>John Doe</h3>
                    <p>No bio available</p>
                    <p>✉ johndoe@gmail.com</p>
                    <div class="flex col-gap">
                        <span>⭐ 0(0 reviews)</span><span>-</span><span>100 points</span><span>-</span><span>1 Badges</span>
                    </div>
                </div>
            </div>
            <!-- badges----------- -->
            <div class="badgeSection">
                <p>🏅 Badges & Achievements</p>
                <div class="badges">
                    <p>🏅</p>
                    <p>Early Bird</p>
                </div>
            </div>
            <!-- skills--------------- -->
            <div class="badgeSection">
                <h4>Skills & Endorsment</h4>

                <p style="margin-top: 10px;">No endorsment yet</p>
                <button class="button-blue" style="margin-top: 10px;">Endorse a Skill</button>

            </div>
            <!-- feedback--------- -->
            <div class="badgeSection">
                <h4>Leave Feedback</h4>

                <p style="margin-top: 10px;">Rating</p>
                <p>⭐⭐⭐⭐⭐</p>
                <p style="margin-top: 10px;">Comment</p>
                <div>
                    <textarea class="text-area" rows="8" name="" id="" placeholder="Share your experience....."></textarea>
                </div>
                <button class="button-blue" style="margin-top: 10px;">💬 Submit Feedback</button>

            </div>

        </div>
    </div>

    <script src="../assets/js/script.js"></script>
</body>

</html>