<?php
require_once(__DIR__ . '/db.php');

function getAllChallenges()
{
    $con = getConnection();
    $sql = "SELECT * FROM challenges ORDER BY points_reward DESC";
    $result = mysqli_query($con, $sql);
    $challenges = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $challenges[] = $row;
    }
    return $challenges;
}

function getUserChallenges($userId)
{
    $con = getConnection();
    $sql = "SELECT uc.*, c.title, c.description, c.points_reward, c.duration_days 
            FROM user_challenges uc 
            JOIN challenges c ON uc.challenge_id = c.id 
            WHERE uc.user_id = '$userId' 
            ORDER BY uc.joined_at DESC";
    $result = mysqli_query($con, $sql);
    $challenges = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $challenges[] = $row;
    }
    return $challenges;
}

function getAvailableChallenges($userId)
{
    $con = getConnection();
    $sql = "SELECT * FROM challenges WHERE id NOT IN (SELECT challenge_id FROM user_challenges WHERE user_id='$userId' AND status='Joined')";
    $result = mysqli_query($con, $sql);
    $challenges = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $challenges[] = $row;
    }
    return $challenges;
}

function joinChallenge($userId, $challengeId)
{
    $con = getConnection();
    $check = "SELECT id FROM user_challenges WHERE user_id='$userId' AND challenge_id='$challengeId' AND status='Joined'";
    $res = mysqli_query($con, $check);
    if (mysqli_num_rows($res) > 0)
        return false;

    $sql = "INSERT INTO user_challenges (user_id, challenge_id, status) VALUES ('$userId', '$challengeId', 'Joined')";
    return mysqli_query($con, $sql);
}

function completeChallenge($userId, $userChallengeId)
{
    $con = getConnection();
    $current = date("Y-m-d H:i:s");
    $sql = "UPDATE user_challenges SET status='Completed', completed_at='$current' WHERE id='$userChallengeId' AND user_id='$userId'";
    return mysqli_query($con, $sql);
}
