<?php
require_once('models/db.php');

$con = getConnection();


$sqlChallenges = "CREATE TABLE IF NOT EXISTS `challenges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `points_reward` int(11) NOT NULL DEFAULT 10,
  `duration_days` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

if (mysqli_query($con, $sqlChallenges)) {
    echo "Table 'challenges' created.<br>";
} else {
    echo "Error creating 'challenges': " . mysqli_error($con) . "<br>";
}


$sqlUserChallenges = "CREATE TABLE IF NOT EXISTS `user_challenges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `challenge_id` int(11) NOT NULL,
  `status` enum('Joined','Completed') NOT NULL DEFAULT 'Joined',
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `completed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `challenge_id` (`challenge_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

if (mysqli_query($con, $sqlUserChallenges)) {
    echo "Table 'user_challenges' created.<br>";
} else {
    echo "Error creating 'user_challenges': " . mysqli_error($con) . "<br>";
}


$seeds = [
    ['Morning Jog', 'Jog for 30 minutes every morning for a week.', 50, 7],
    ['No Sugar', 'Avoid sugary drinks and sweets for 3 days.', 30, 3],
    ['Read a Book', 'Read 20 pages of a self-improvement book today.', 15, 1],
    ['Meditation', 'Meditate for 10 minutes.', 10, 1],
    ['Water Intake', 'Drink 3 liters of water today.', 10, 1]
];

foreach ($seeds as $s) {
    $title = $s[0];
    $check = mysqli_query($con, "SELECT id FROM challenges WHERE title='$title'");
    if (mysqli_num_rows($check) == 0) {
        $desc = mysqli_real_escape_string($con, $s[1]);
        $sql = "INSERT INTO challenges (title, description, points_reward, duration_days) VALUES ('$title', '$desc', {$s[2]}, {$s[3]})";
        mysqli_query($con, $sql);
    }
}
echo "Seed data inserted.<br>";
?>