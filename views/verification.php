<?php
require_once('../controllers/authCheck.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/menuStyle.css" />
</head>

<body>
    <div class="flex">
        <div class="menubar">
            <?php require_once "menubar.php"; ?>
        </div>
        <div class="container">
            <div>
                <h3>Organization Verification Center</h3>
                <p>Manage your organization verification</p>
                <div class="uploadDoc">
                    <div class="flex fileUp">
                        <div>
                            <div class="flex align-center">
                                <img src="../assets/images/check.png" alt="" style="width: 18px; height: 18px; margin-right: 4px;" /><span style="font-weight: 600;">
                                    Organization Verification
                                </span>
                            </div>
                            <p>Upload documents for admin verification</p>
                        </div>
                        <form id="verifyForm" enctype="multipart/form-data">
                            <div class="subBtn" style="cursor: pointer;" onclick="document.getElementById('verifyInput').click();">
                                <img src="../assets/images/upload.png" style="width: 13px; height: 13px; margin-right: 8px;" alt="" />
                                <a>Submit for Verification</a>
                            </div>
                            <input type="file" id="verifyInput" name="myfile" style="display:none;" onchange="uploadVerificationFile()">
                        </form>
                    </div>
                    
                    <div id="verificationDocs" style="margin-top: 15px; padding: 10px; border: 1px dashed #ccc; border-radius: 5px;">
                        <?php 
                        // Fetch verification documents
                        require_once('../models/siyan_userModel.php');
                        // Ensure session email is available or handled
                        if(isset($_SESSION['email'])) {
                            $verifyDocs = getVerificationDocuments($_SESSION['email']);
                            
                            if (empty($verifyDocs)): ?>
                                <div id="emptyVerifyMsg">No verification documents submitted yet</div>
                            <?php else: 
                                foreach ($verifyDocs as $doc): 
                                    $isVerified = ($doc['status'] == 'verified');
                                ?>
                                <div id="verify-<?= $doc['id'] ?>" style="display: flex; justify-content:space-between; align-items: center; gap: 15px; border: 1px solid #ddd; margin:10px; padding: 10px; border-radius: 5px; width:90%;">
                                    <div>
                                        <img src="../assets/images/file.png" style="width: 16px; height: 16px;" />
                                        <strong><?= htmlspecialchars($doc['file_name']) ?></strong>
                                    </div>
                                    <div style="display: flex; gap: 10px;">
                                        <a href="<?= $doc['file_path'] ?>" download style="background: #28a745; color: white; padding: 5px 12px; text-decoration: none; border-radius: 4px; font-size: 14px;">Download</a>
                                        
                                        <?php if($isVerified): ?>
                                            <button disabled style="background: #28a745; color: white; padding: 5px 12px; border: none; border-radius: 4px; font-size: 14px; cursor: default;">Verified</button>
                                        <?php else: ?>
                                            <button id="btn-verify-<?= $doc['id'] ?>" onclick="verifyFile(<?= $doc['id'] ?>)" style="background: #007bff; color: white; padding: 5px 12px; border: none; border-radius: 4px; font-size: 14px; cursor: pointer;">Verify Now</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; 
                            endif;
                        } else {
                            echo "Please login to view documents.";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/siyanScript.js?v=<?= time() ?>"></script>
</body>

</html>