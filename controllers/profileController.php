<?php
require_once('../models/userModel.php');
session_start();

if (!isset($_SESSION['email'])) {
    header('location: ../views/signin.php');
    exit();
}

$email = $_SESSION['email'];
$currentUser = getUserInfo($email);

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

    // AJAX Handle File Upload 
    if (isset($_POST['ajax_upload_pic'])) {
        $response = ['success' => false, 'error' => 'Unknown error'];

        if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
            $uploadDir = '../assets/uploadProfilePic/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = time() . '_' . basename($_FILES['profile_pic']['name']);
            $targetPath = $uploadDir . $fileName;
            $fileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $targetPath)) {
                    // Update DB with new pic
                    if (updateUser($currentUser['id'], ['fullName' => $currentUser['fullName'], 'email' => $currentUser['email'], 'phone' => $currentUser['phone'], 'bio' => $currentUser['bio'], 'location' => $currentUser['location'], 'profile_pic' => $fileName])) {
                        $response = ['success' => true, 'filePath' => $targetPath];
                    } else {
                        $response = ['success' => false, 'error' => 'Database update failed'];
                    }
                } else {
                    $response = ['success' => false, 'error' => 'File move failed'];
                }
            } else {
                $response = ['success' => false, 'error' => 'Invalid file type'];
            }
        } else {
             $response = ['success' => false, 'error' => 'No file uploaded or error'];
        }
        
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    
   
    
   
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $uploadDir = '../assets/uploadProfilePic/';
        
        
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = time() . '_' . basename($_FILES['profile_pic']['name']);
        $targetPath = $uploadDir . $fileName;
        $fileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));

        
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $targetPath)) {
                $data['profile_pic'] = $fileName;
            } else {
                header('location: ../views/profilemanagement.php?error=upload_failed');
                exit();
            }
        } else {
            header('location: ../views/profilemanagement.php?error=invalid_file_type');
            exit();
        }
    }

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
        if (updatePassword($currentUser['id'], $newPassword)) {
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