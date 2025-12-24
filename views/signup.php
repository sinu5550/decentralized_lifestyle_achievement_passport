<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>
   <link rel="stylesheet" href="../assets/css/style-R.css" />
  </head>
  <body>
    <div class="flex">
      <div class="container">
        <div class="heading">
          <h3>Creat Account</h3>
          <h4>Join the Lifestyle Achivement Passport</h4>
        </div>
        <div class="namefield">
          <div>
            <label for="fname">First Name</label>
            <br />
            <input
              id="fname"
              type="text"
              name="First Name"
              onblur="testname()"
            />
          </div>
          <div>
            <label for="lname">Last Name</label>
            <br />
            <input
              id="lname"
              type="text"
              name="Last Name"
              onblur="testname()"
            />
          </div>
        </div>
        <div id="nameError"></div>
        <br />
        <div>
          <label for="email">Email</label>
          <br />
          <input id="email" type="email" name="email" 
          onblur="validateEmail()"/>
          <p id="emailerror"></p>
          <label for="password">Password</label>
          <br />
          <input
            id="password"
            type="password"
            name="password"
            onblur="testPassword()"
          />
          <p id="pError"></p>

          <label for="confirmPassword">Confirm Password</label>
          <br />
          <input id="cpassword" type="password" name="confirmPassword" onblur="confirmPassword()" />
          <p id="cperror"></p>
        </div>
        <br />
        <div>
          <input type="submit" value="Creat Account" />
        </div>
        <div>
          <h4>Already have an account? <a href="signin.php">Sign In</a></h4>
        </div>
      </div>
    </div>
    <script src="../assets/js/script.js"></script>
  </body>
</html>
