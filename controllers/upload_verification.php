<?php
session_start();
require_once('../models/db.php');
require_once('../models/siyan_userModel.php');

if (!isset($_SESSION['email'])) {
    echo "Error: Session expired. Please login again.";
    exit;
}

if (isset($_FILES['myfile'])) {
    $email = $_SESSION['email'];
    $originalName = $_FILES['myfile']['name'];

    $dir = '../assets/verificationDoc/';
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    $parts = explode('.', $originalName);
    $ext = end($parts);

    $newName = time() . "_" . substr($email, 0, 5) . "_verify." . $ext;
    $des = $dir . $newName;

    if (move_uploaded_file($_FILES['myfile']['tmp_name'], $des)) {
        $id = saveVerificationDocument($email, $originalName, $des);
        if ($id) {
            echo "Done|" . $des . "|" . $originalName . "|" . $id . "|pending";
        } else {
            echo "Error: Database failed.";
        }
    } else {
        echo "Error: Upload failed.";
    }
}
