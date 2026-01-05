<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In</title>
    <link rel="stylesheet" href="../assets/css/signin.css">
     
</head>
<body>
    <div class="flex">
        <div class="container">
            <div class="heading">
                <h3>Lifestyle Achievement Passport</h3>
                <h4>Sign in to your account</h4>
            </div>

            <form method="POST" action="../controllers/signinCheck.php">
                <div class="field-group">
                    <label for="email">Email</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        <input type="email" name="email" placeholder="Enter your email" />
                    </div>
                </div>

                <div class="field-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <input type="password" name="password" placeholder="Enter your password" />
                    </div>
                </div>

                <div class="forgot-link">
                    <a href="resetpassword.php">Forgot Password?</a>
                </div>

                <div class="button-group">
                    <input type="submit" name="submit" value="Sign In" class="btn-submit" />
                </div>

                <div class="signup-footer">
                    <h4>Don't have an account? <a href="signup.php">Sign Up</a></h4>
                </div>
            </form>
        </div>
    </div>
</body>
</html>