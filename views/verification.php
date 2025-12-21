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
                        <form>
                            <div class="subBtn">
                                <img src="../assets/images/upload.png" style="width: 13px; height: 13px; margin-right: 8px;" alt="" />
                                <a type="submit">Submit for Verification</a>
                            </div>
                        </form>
                    </div>
                    <div id="document">No verification documents submitted yet</div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/script.js"></script>
</body>

</html>