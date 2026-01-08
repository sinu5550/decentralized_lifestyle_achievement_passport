<?php
require_once 'models/dbConnection.php';

$con = dbConnection();

// User Rewards (Points Balance)
$sql1 = "CREATE TABLE IF NOT EXISTS user_rewards (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL UNIQUE,
    points INT(11) DEFAULT 0,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (mysqli_query($con, $sql1)) {
    echo "Table user_rewards created successfully.<br>";
} else {
    echo "Error creating user_rewards table: " . mysqli_error($con) . "<br>";
}

// Badges Definitions
$sql2 = "CREATE TABLE IF NOT EXISTS badges (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    points_required INT(11) NOT NULL,
    icon VARCHAR(100) -- Icon class or filename
)";

if (mysqli_query($con, $sql2)) {
    echo "Table badges created successfully.<br>";
} else {
    echo "Error creating badges table: " . mysqli_error($con) . "<br>";
}

// User Badges (Unlocked)
$sql3 = "CREATE TABLE IF NOT EXISTS user_badges (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    badge_id INT(11) NOT NULL,
    awarded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY user_badge_unique (user_id, badge_id)
)";

if (mysqli_query($con, $sql3)) {
    echo "Table user_badges created successfully.<br>";
} else {
    echo "Error creating user_badges table: " . mysqli_error($con) . "<br>";
}

// Insert Default Badges
$badges = [
    ['Novice Achiever', 'Earned 50 points', 50, 'badge_novice.png'],
    ['Regular Contributor', 'Earned 150 points', 150, 'badge_regular.png'],
    ['Impact Maker', 'Earned 300 points', 300, 'badge_impact.png'],
    ['Legend', 'Earned 500 points', 500, 'badge_legend.png']
];

foreach ($badges as $badge) {
    $name = $badge[0];
    $desc = $badge[1];
    $points = $badge[2];
    $icon = $badge[3];
    
    // Check if exists to avoid dupes on re-run
    $check = mysqli_query($con, "SELECT id FROM badges WHERE name='$name'");
    if (mysqli_num_rows($check) == 0) {
        $sql = "INSERT INTO badges (name, description, points_required, icon) VALUES ('$name', '$desc', '$points', '$icon')";
        mysqli_query($con, $sql);
        echo "Inserted badge: $name<br>";
    }
}
?>
