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
            <div>
              <div class="center">
                <img src="../assets/images/file.png" alt="" style="width: 13px; height: 13px; margin-right: 8px;" /><span>
                  Personal Documents
                </span>
              </div>
            </div>
            <form>
              <div class="upBtn">
                <img src="../assets/images/upload.png" style="width: 13px; height: 13px; margin-right: 8px;" alt="" />
                <a type="submit">Upload Document</a>
              </div>
            </form>
          </div>
          <div id="document">No documents uploaded yet</div>
        </div>
      </div>
    </div>
  </div>

  <script src="../assets/js/script.js"></script>
</body>

</html>