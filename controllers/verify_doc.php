<?php
session_start();
require_once('../models/db.php');
require_once('../models/siyan_userModel.php');

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    
    if(verifyDocument($id)) {
        echo "Success";
    } else {
        echo "Error: Database update failed";
    }
}
?>
