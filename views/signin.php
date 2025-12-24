<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In</title>
   <link rel="stylesheet" href="../assets/css/style-R.css" />
  </head>
  <body>
    <div class="flex">
      <div class="container">
        <div class="heading">
          <h3>Lifestyle Achivement Passport</h3>
        <h4>Sign in to your account</h4>
        </div>
        <div>
          <label for="email">Email</label>
          <br />
          <input type="email" name="email" />
          <br />
          <br />

          <label for="password">Password</label>
          <br />
          <input type="password" name="password" />
        </div>
        <br />
        <div>
          <a href="resetpassword.php">Forgot Password?</a>
        </div>
        <br />
        <div>
          <input type="submit" value="Sign In" />
        </div>
        <div>
          <h4>Don't have an account? <a href="signup.php">Sign Up</a></h4>
        </div>
      </div>
    </div>
  </body>
</html>
