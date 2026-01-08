<?php
session_start();
require_once('../models/db.php');
require_once('../models/siyan_userModel.php');

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $doc = getDocumentById($id);
    
    if($doc) {
        $filePath = $doc['file_path'];
        if(file_exists($filePath)) {
            unlink($filePath);
        }
        
        if(deleteDocument($id)) {
            echo "Success";
        } else {
            echo "Error: Database deletion failed";
        }
    } else {
        echo "Error: Document not found";
    }
}
?>
