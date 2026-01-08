<?php
require_once('../controllers/authCheck.php');
require_once('../models/userModel.php');
require_once('../models/diaryModel.php');

$email = $_SESSION['email'];
$currentUser = getUserInfo($email);
$entries = getEntries($currentUser['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Personal Diary</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/menuStyle.css">
    <link rel="stylesheet" href="../assets/css/diary.css">
</head>

<body>
    <div class="flex">
        <div class="menubar">
            <?php require_once "menubar.php"; ?>
        </div>
        <div class="container">
            <h2 style="margin-bottom: 20px;">📖 Personal Diary</h2>

            <div
                style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 30px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <h4 style="margin-bottom: 15px;">Write a new entry</h4>
                <form action="../controllers/diaryController.php" method="POST">
                    <div style="margin-bottom: 15px;">
                        <input type="text" name="title" placeholder="Title (e.g., A productive day!)"
                            class="text-area autocomplete-input"
                            style="width: 100%; box-sizing: border-box; padding: 10px; border: 1px solid #ddd; border-radius: 5px;"
                            required>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <textarea name="content" placeholder="Dear Diary..." class="text-area" rows="6"
                            style="width: 100%; box-sizing: border-box; padding: 10px; border: 1px solid #ddd; border-radius: 5px;"
                            required></textarea>
                    </div>
                    <button type="submit" name="add_entry" class="button-blue">Save Entry</button>
                </form>
            </div>

            <h4 style="margin-bottom: 15px;">Past Entries</h4>
            <?php if (empty($entries)): ?>
                <p style="color: #777; text-align: center;">You haven't written anything yet. Start today!</p>
            <?php else: ?>
                <?php foreach ($entries as $entry): ?>
                    <div class="diary-entry">
                        <a href="../controllers/diaryController.php?delete_id=<?= $entry['id'] ?>" class="delete-btn"
                            onclick="return confirm('Delete this entry?');">Delete</a>
                        <div class="diary-date">
                            <?= date('F j, Y, g:i a', strtotime($entry['created_at'])) ?>
                        </div>
                        <div class="diary-title">
                            <?= htmlspecialchars($entry['title']) ?>
                        </div>
                        <div style="white-space: pre-wrap; line-height: 1.6; color: #444;">
                            <?= htmlspecialchars($entry['content']) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>