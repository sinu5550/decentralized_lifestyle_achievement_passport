<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile Management</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
  </head>
  <body>
    <div class="flex">
      <div class="container">
        
        <div class="heading">
          <h3>Profile Management</h3>
        </div>
        <div class="picture">
          <img src="../assets/images/img1.jpg" alt="profile picture" class="ppicture">
          </div>
           <div>
            <h5 style="text-align: center;">Click the camera icon to upload a profile picture</h5>
           </div>
        <div class="namefield">
          <div>
            <label for="fname">First Name</label>
            <br />
            <input type="text" name="First Name" />
          </div>
          <div>
            <label for="lname">Last Name</label>
            <br />
            <input type="text" name="Last Name" />
          </div>
        </div>
        <br />
        <div>
          <label for="email">Email</label>
          <br />
          <input type="email" name="email" />
          <br />
        </div>
        <div>
          <label for="phone number">Phone Number</label>
          <br />
          <input type="number" name="phone_number" />
        </div>
        <div>
          <label for="bio">Bio</label>
          <br />
          <textarea name="bio" class="bio"></textarea>
        </div>
        <a href="personalized_dashboard.php"><button>Save Changes</button></a>
      </div>
    </div>
  </body>
</html>
