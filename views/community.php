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
      <div>
        <h3>Community Profiles</h3>
        <span>Connect with other members and their achievements</span>
        <div class="flex communityCards">
          <div class="card">
            <div>
              <div class="cardCenter">
                <img
                  class="profilePic"
                  src="../assets/images/profile.PNG"
                  alt="" />
                <p>John Doe</p>
                <p>⭐ 0(0)</p>
              </div>
              <div class="flexGap"><span>Points</span>100</div>
              <div class="flexGap"><span>Badges</span>1</div>

              <button class="viewBtn">View Profile</button>
            </div>
          </div>
          <div class="card">
            <div>
              <div class="cardCenter">
                <img
                  class="profilePic"
                  src="../assets/images/profile.PNG"
                  alt="" />
                <p>John Doe</p>
                <p>⭐ 0(0)</p>
              </div>
              <div class="flexGap"><span>Points</span>100</div>
              <div class="flexGap"><span>Badges</span>1</div>

              <button class="viewBtn">View Profile</button>
            </div>
          </div>
          <div class="card">
            <div>
              <div class="cardCenter">
                <img
                  class="profilePic"
                  src="../assets/images/profile.PNG"
                  alt="" />
                <p>John Doe</p>
                <p>⭐ 0(0)</p>
              </div>
              <div class="flexGap"><span>Points</span>100</div>
              <div class="flexGap"><span>Badges</span>1</div>

              <button class="viewBtn">View Profile</button>
            </div>
          </div>
          <div class="card">
            <div>
              <div class="cardCenter">
                <img
                  class="profilePic"
                  src="../assets/images/profile.PNG"
                  alt="" />
                <p>John Doe</p>
                <p>⭐ 0(0)</p>
              </div>
              <div class="flexGap"><span>Points</span>100</div>
              <div class="flexGap"><span>Badges</span>1</div>

              <button class="viewBtn">View Profile</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="../assets/js/script.js"></script>
</body>

</html>