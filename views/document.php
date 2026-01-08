<?php

require_once('../models/db.php');
require_once('../models/siyan_userModel.php');
require_once('../controllers/authCheck.php');

$email = $_SESSION['email'];
$myDocs = getUserDocuments($email);
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
        <h3>Document Storage Center</h3>
        <p>Manage your personal documents</p>
        <div class="uploadDoc">
          <div class="flex fileUp">
            <div class="center">
              <img src="../assets/images/file.png" style="width: 13px; height: 13px; margin-right: 8px;" />
              <span>Personal Documents</span>
            </div>

            <form id="myform" enctype="multipart/form-data">
              <div class="upBtn" style="cursor: pointer;" onclick="document.getElementById('fileInput').click();">
                <img src="../assets/images/upload.png" style="width: 13px; height: 13px; margin-right: 8px;" alt="" />
                <a>Upload Document</a>
              </div>
              <input type="file" id="fileInput" name="myfile" style="display:none;" onchange="uploadFile()">
            </form>
          </div>

          <div id="document" style="margin-top: 15px; padding: 10px; border: 1px dashed #ccc; border-radius: 5px; ">
            <?php if (empty($myDocs)): ?>
              <p id="emptyMsg">No documents uploaded yet.</p>
            <?php else: ?>
              <?php foreach ($myDocs as $doc): ?>
                <div id="doc-<?= $doc['id'] ?>" style="display: flex; justify-content:space-between; align-items: center; gap: 15px; border: 1px solid #ddd; margin:10px; padding: 10px; border-radius: 5px; width:90%;">
                  <div>
                    <img src="../assets/images/file.png" style="width: 16px; height: 16px;" />
                    <strong><?= htmlspecialchars($doc['file_name']) ?></strong>
                  </div>
                  <div style="display: flex; gap: 10px;">
                    <a href="<?= $doc['file_path'] ?>" download style="background: #28a745; color: white; padding: 5px 12px; text-decoration: none; border-radius: 4px; font-size: 14px;">Download</a>
                    <button onclick="deleteFile(<?= $doc['id'] ?>)" style="background: #dc3545; color: white; padding: 5px 12px; border: none; border-radius: 4px; font-size: 14px; cursor: pointer;">Delete</button>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script src="../assets/js/siyanScript.js?v=<?= time() ?>"></script>
</body>

</html>