<?php
    require_once('../models/userModel.php');
    require_once('../controllers/authCheck.php');
    $user = getUserInfo($_SESSION['email']);
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile Management</title>
    <link rel="stylesheet" href="../assets/css/profile.css" />
    <link rel="stylesheet" href="../assets/css/menuStyle.css" />
</head>

<body>
    <?php
    if (isset($_GET['success'])) {
        if ($_GET['success'] == 'updated') echo "<script>alert('Profile updated successfully!');</script>";
        if ($_GET['success'] == 'password_changed') echo "<script>alert('Password changed successfully!');</script>";
    }
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'short_password') echo "<script>alert('Password must be at least 8 characters long!');</script>";
        if ($_GET['error'] == 'update_failed') echo "<script>alert('Failed to update profile.');</script>";
        
        if ($_GET['error'] == 'password_mismatch') echo "<script>alert('Passwords do not match!');</script>";
    }
    ?>
    <div class="flex">
        <div class="menubar">
            <?php require_once "menubar.php"; ?>
        </div>



        <div class="container-main">
            <div class="profile-card">
                <div class="heading">
                    <h3>Profile Management</h3>
                </div>

                <div class="picture-container">
                    <div class="pp-wrapper" onclick="document.getElementById('profile_pic_input').click()"
                        style="cursor: pointer;">
                        <?php 
            $profilePicPath = isset($user['profile_pic']) && !empty($user['profile_pic']) && $user['profile_pic'] != 'default.png' 
                              ? "../assets/uploadProfilePic/" . $user['profile_pic'] 
                              : "../assets/images/img1.jpg"; 
          ?>
                        <img src="<?= $profilePicPath ?>" alt="profile picture" class="ppicture">
                        <div class="camera-icon">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z">
                                </path>
                                <circle cx="12" cy="13" r="4"></circle>
                            </svg>
                        </div>
                    </div>
                    <p class="upload-hint">Click the camera icon to upload a profile picture</p>
                </div>

                <hr class="divider">

                <form class="profile-form" action="../controllers/profileController.php" method="POST"
                    enctype="multipart/form-data">
                    <input type="file" name="profile_pic" id="profile_pic_input" style="display: none;">

                    <div class="form-grid">
                        <div class="field-group">
                            <label>Full Name</label>
                            <div class="input-wrapper">
                                <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <input type="text" name="full_name" value="<?= htmlspecialchars($user['fullName']) ?>"
                                    placeholder="Full Name">
                            </div>
                        </div>

                        <div class="field-group">
                            <label>Email</label>
                            <div class="input-wrapper">
                                <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path
                                        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                    </path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>"
                                    placeholder="example@gmail.com" readonly
                                    style="background-color: #f0f0f0; cursor: not-allowed; color: #666;">
                            </div>
                        </div>

                        <div class="field-group">
                            <label>Phone Number</label>
                            <div class="input-wrapper">
                                <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                    </path>
                                </svg>
                                <input type="text" name="phone_number"
                                    value="<?= isset($user['phone']) ? htmlspecialchars($user['phone']) : '' ?>"
                                    placeholder="Optional">
                            </div>
                        </div>

                        <div class="field-group">
                            <label>Location</label>
                            <div class="input-wrapper">
                                <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <input type="text" name="location"
                                    value="<?= isset($user['location']) ? htmlspecialchars($user['location']) : '' ?>"
                                    placeholder="Optional">
                            </div>
                        </div>
                    </div>

                    <div class="field-group full-width">
                        <label>Bio</label>
                        <textarea name="bio"
                            placeholder="Tell us about yourself..."><?= isset($user['bio']) ? htmlspecialchars($user['bio']) : '' ?></textarea>
                    </div>

                    <button type="submit" name="update_profile" class="save-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Save Changes
                    </button>
                </form>

                <hr class="divider" style="margin: 30px 0;">

                <!-- Reset Password Section -->
                <div class="heading">
                    <h3>Reset Password</h3>
                </div>
                <form class="profile-form" action="../controllers/profileController.php" method="POST">
                    <div class="form-grid">
                        <div class="field-group">
                            <label>New Password</label>
                            <div class="input-wrapper">
                                <input type="password" name="new_password" required placeholder="New Password">
                            </div>
                        </div>
                        <div class="field-group">
                            <label>Confirm Password</label>
                            <div class="input-wrapper">
                                <input type="password" name="confirm_password" required placeholder="Confirm Password">
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="reset_password" class="save-btn"
                        style="background: #e74c3c; margin-top: 15px;">
                        Reset Password
                    </button>
                </form>
            </div>
        </div>
    </div>

<script>
document.getElementById('profile_pic_input').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const formData = new FormData();
        formData.append('profile_pic', file);
        formData.append('ajax_upload_pic', true);

        const xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../controllers/profileController.php', true);

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const response = this.responseText.trim();
                if (response.includes('Done')) {
                    const parts = response.split('|');
                    const filePath = parts[1];
                    document.querySelector('.ppicture').src = filePath;
                    document.getElementById('profile_pic_input').value = ''; 
                } else {
                    console.error('Upload error: ' + response);
                }
            }
        };

        xhttp.send(formData);
    }
});
</script>
</body>

</html>