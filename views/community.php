<?php
require_once('../controllers/authCheck.php');
require_once('../models/siyan_userModel.php');

$allUsers = getAllUsers();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Community Profiles</title>
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="stylesheet" href="../assets/css/menuStyle.css" />
</head>

<body>
  <div class="flex">
    <div class="menubar">
      <?php require_once "menubar.php"; ?>
    </div>
    <div class="container">
      <div style="width: 800px;">
        <h3>Community Profiles</h3>
        <span>Connect with other members and their achievements</span>

        <div class="flex communityCards">

          <?php foreach ($allUsers as $u): ?>
            <div class="card">
              <div>
                <div class="cardCenter">
                  <img class="profilePic" src="../assets/images/profile.PNG" alt="" />
                  <p><strong><?= htmlspecialchars($u["fullName"]) ?></strong></p>
                  <?php 
                      $ratingData = getUserAverageRating($u['id']);
                      $avgRating = number_format($ratingData['avg_rating'], 1);
                      $count = $ratingData['count'];
                  ?>
                  <p>⭐ <?= $avgRating ?> (<?= $count ?>)</p>
                </div>
                <div class="flexGap"><span>Points</span>100</div>
                <div class="flexGap"><span>Badges</span>1</div>

                <div class="viewBtn">
                  <a href="communityProfile.php?id=<?= $u['id'] ?>">View Profile</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>

        </div>
      </div>
    </div>
  </div>

  <script src="../assets/js/script.js"></script>
</body>

</html>