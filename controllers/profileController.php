<?php
require_once('../models/userModel.php');
session_start();

if (!isset($_SESSION['email'])) {
    header('location: ../views/signin.php');
    exit();
}

$email = $_SESSION['email'];
$currentUser = getUserInfo($email);

// AJAX Handle File Upload 
if (isset($_POST['ajax_upload_pic'])) {
    if (isset($_FILES['profile_pic'])) {
        $email = $_SESSION['email'];
        $originalName = $_FILES['profile_pic']['name'];

        $uploadDir = '../assets/uploadProfilePic/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $parts = explode('.', $originalName);
        $ext = end($parts);

        $fileName = time() . "_" . substr($email, 0, 5) . "." . $ext;
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $targetPath)) {
        
             if (updateUser($currentUser['id'], ['fullName' => $currentUser['fullName'], 'email' => $currentUser['email'], 'phone' => $currentUser['phone'], 'bio' => $currentUser['bio'], 'location' => $currentUser['location'], 'profile_pic' => $fileName])) {
                echo "Done|" . $targetPath;
            } else {
                echo "Error: Database update failed";
            }
        } else {
            echo "Error: File move failed";
        }
    } else {
         echo "Error: No file uploaded";
    }
    exit();
}

if (isset($_POST['update_profile'])) {
    $fullName = $_POST['full_name'];
    $emailAddr = $email; 
    $phone = $_POST['phone_number'];
    $location = $_POST['location'];
    $bio = $_POST['bio'];

    $data = [
        'fullName' => $fullName,
        'email' => $emailAddr,
        'phone' => $phone,
        'location' => $location,
        'bio' => $bio
    ]; 

    if (updateUser($currentUser['id'], $data)) {
       
        if ($emailAddr != $email) {
            $_SESSION['email'] = $emailAddr;
        }
        header('location: ../views/profilemanagement.php?success=updated');
    } else {
        header('location: ../views/profilemanagement.php?error=update_failed');
    }

} elseif (isset($_POST['reset_password'])) {
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if (!empty($newPassword) && ($newPassword === $confirmPassword)) {
        if(strlen($newPassword) < 8) {
            header('location: ../views/profilemanagement.php?error=short_password');
        } elseif (updatePassword($currentUser['id'], $newPassword)) {
            header('location: ../views/profilemanagement.php?success=password_changed');
        } else {
            header('location: ../views/profilemanagement.php?error=db_error');
        }
    } else {
        header('location: ../views/profilemanagement.php?error=password_mismatch');
    }

} else {
    header('location: ../views/profilemanagement.php');
}
?>