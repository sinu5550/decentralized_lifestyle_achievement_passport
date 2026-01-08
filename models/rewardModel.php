<?php
require_once('dbConnection.php');

function getPoints($userId)
{
    $conn = dbConnection();
    $userId = mysqli_real_escape_string($conn, $userId);

    $sql = "SELECT points FROM user_rewards WHERE user_id='$userId'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['points'];
    }
    return 0;
}

function addPoints($userId, $amount)
{
    $conn = dbConnection();
    $userId = mysqli_real_escape_string($conn, $userId);
    $amount = (int) $amount;


    $check = mysqli_query($conn, "SELECT id FROM user_rewards WHERE user_id='$userId'");
    if (mysqli_num_rows($check) == 0) {
        $sql = "INSERT INTO user_rewards (user_id, points) VALUES ('$userId', '$amount')";
    } else {
        $sql = "UPDATE user_rewards SET points = points + $amount WHERE user_id='$userId'";
    }

    if (mysqli_query($conn, $sql)) {

        checkBadges($userId);
        return true;
    }
    return false;
}

function checkBadges($userId)
{
    $conn = dbConnection();
    $userId = mysqli_real_escape_string($conn, $userId);

    $currentPoints = getPoints($userId);

    $sql = "SELECT * FROM badges WHERE points_required <= $currentPoints";
    $result = mysqli_query($conn, $sql);

    while ($badge = mysqli_fetch_assoc($result)) {
        $badgeId = $badge['id'];


        $check = mysqli_query($conn, "SELECT id FROM user_badges WHERE user_id='$userId' AND badge_id='$badgeId'");
        if (mysqli_num_rows($check) == 0) {

            mysqli_query($conn, "INSERT INTO user_badges (user_id, badge_id) VALUES ('$userId', '$badgeId')");

        }
    }
}

function getBadges($userId)
{
    $conn = dbConnection();
    $userId = mysqli_real_escape_string($conn, $userId);


    $sql = "SELECT * FROM badges ORDER BY points_required ASC";
    $result = mysqli_query($conn, $sql);

    $badges = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $badgeId = $row['id'];


        $check = mysqli_query($conn, "SELECT awarded_at FROM user_badges WHERE user_id='$userId' AND badge_id='$badgeId'");
        $unlocked = (mysqli_num_rows($check) > 0);
        $row['unlocked'] = $unlocked;

        if ($unlocked) {
            $award = mysqli_fetch_assoc($check);
            $row['awarded_at'] = $award['awarded_at'];
        }

        $badges[] = $row;
    }
    return $badges;
}
?>
