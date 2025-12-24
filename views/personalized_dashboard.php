<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style-R.css" />
    <link rel="stylesheet" href="../assets/css/menuStyle.css" />
  </head>
  <body>
    <div class="flex">
      <div class="menubar">
            <?php require_once "menubar.php"; ?>
      </div>
    <div class="container">
      <section class="scoring">
        <div class="card">
          <h3>Reputation Score</h3>
          <p>00</p>
        </div>
        <div class="card">
          <h3>Total Points</h3>
          <p>00</p>
        </div>
        <div class="card">
          <h3>Goals Progress</h3>
          <p>00</p>
        </div>
        <div class="card">
          <h3>Active Challenges</h3>
          <p>00</p>
        </div>
      </section>
      <div>
      <section class="quickSection">
        <div><h3>Quick Actions</h3></div>
        <div class="Quick_Actions">
          <div class="activity">
            <h3>Creat Goal</h3>
            <p>Set new objectives</p>
          </div>
          <div class="activity">
            <h3>Take Challenge</h3>
            <p>Join daily Challenges</p>
          </div>
          <div class="activity">
            <h3>Community</h3>
            <p>View user profiles</p>
          </div>
          <div class="activity">
            <h3>Generate CV</h3>
            <p>Download resume</p>
          </div>
        </div>
      </section>
    </div>
    </div>

    
    </div>
  </body>
</html>
