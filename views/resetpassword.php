<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password</title>
    <link rel="stylesheet" href="../assets/css/resetpass.css" />
</head>
<body>
    <div class="flex-wrapper">
        <div class="reset-container">
            <div class="heading">
                <h4>Reset Password</h4>
                <h3>Create a new password</h3>
            </div>

            

            <form action="signin.php">
                <div class="field-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Enter your email" required />
                </div>

                <div class="field-group">
                    <label for="password">New Password</label>
                    <input type="password" name="password" placeholder="Enter new password" required />
                </div>

                <div class="field-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" name="confirm-password" placeholder="Confirm new password" required />
                </div>

                <div class="button-group">
                    <button type="submit" class="btn-reset">Reset Password</button>
                </div>
            </form>

            <div class="footer-link">
                <a href="signin.php">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    Back to Login
                </a>
            </div>
        </div>
    </div>
</body>
</html>