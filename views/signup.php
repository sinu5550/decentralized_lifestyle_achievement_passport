<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>
    <link rel="stylesheet" href="../assets/css/signup.css" />
</head>
<body>
    <div class="flex">
        <form action="../controllers/signupCheck.php" method="post" class="container">
            <div class="heading">
                <h3>Create Account</h3>
                <h4>Join the Lifestyle Achievement Passport</h4>
            </div>
            <div class="field-group">
              <div class="namefield">
                <div>
                    <label for="fname">First Name</label>
                    <input id="fname" type="text" name="First_Name" onblur="testname()" placeholder="First name" />
                </div>
                <div >
                    <label for="lname">Last Name</label>
                    <input id="lname" type="text" name="Last_Name" onblur="testname()" placeholder="Last name" />
                </div>
              </div>
              <small id="nameError" class="error-msg"></small>
            </div>
            
            

            <div class="field-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" onblur="validateEmail()" placeholder="Enter your email" />
                <small id="emailerror" class="error-msg"></small>
            </div>

            <div class="field-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" onblur="testPassword()" placeholder="Create password" />
                <small id="pError" class="error-msg"></small>
            </div>

            <div class="field-group">
                <label for="confirmPassword">Confirm Password</label>
                <input id="cpassword" type="password" name="confirmPassword" onblur="confirmPassword()" placeholder="Confirm password" />
                <small id="cperror" class="error-msg"></small>
            </div>

            <div class="button-group">
                <input type="submit" name="submit" value="Create Account" class="btn-submit" />
            </div>

            <div class="signup-footer">
                <h4>Already have an account? <a href="signin.php">Sign In</a></h4>
            </div>
        </form>
    </div>
    <script src="../assets/js/rumaiyaScript.js"></script>
</body>
</html>