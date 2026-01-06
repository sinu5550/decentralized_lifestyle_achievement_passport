<?php
require_once(__DIR__ . '/db.php');

function createGoal($userId, $goal)
{
    $con = getConnection();
    $title = mysqli_real_escape_string($con, $goal['title']);
    $description = mysqli_real_escape_string($con, $goal['description']);
    $deadline = mysqli_real_escape_string($con, $goal['deadline']);

    $sql = "INSERT INTO user_goal (user_id, title, description, deadline, status, progress) 
            VALUES ('$userId', '$title', '$description', '$deadline', 'Active', 0)";

    if (mysqli_query($con, $sql)) {
        return true;
    } else {
        return false;
    }
}

function getUserGoals($userId)
{
    $con = getConnection();
    $sql = "SELECT * FROM user_goal WHERE user_id = '$userId' ORDER BY created_at DESC";
    $result = mysqli_query($con, $sql);

    $goals = [];
    while ($row = mysqli_fetch_assoc($result)) {
        // Fetch milestones for each goal
        $row['milestones'] = getMilestones($row['id']);
        $goals[] = $row;
    }
    return $goals;
}

function deleteGoal($id)
{
    $con = getConnection();
    // Delete milestones first (cascade manually if not set in DB)
    $sqlDelM = "DELETE FROM goal_milestones WHERE goal_id = '$id'";
    mysqli_query($con, $sqlDelM);

    $sql = "DELETE FROM user_goal WHERE id = '$id'";
    return mysqli_query($con, $sql);
}

// --- Milestone Functions ---

function addMilestone($goalId, $title)
{
    $con = getConnection();
    $title = mysqli_real_escape_string($con, $title);
    $sql = "INSERT INTO goal_milestones (goal_id, title, is_completed) VALUES ('$goalId', '$title', 0)";
    if (mysqli_query($con, $sql)) {
        updateGoalProgressFromMilestones($goalId);
        return true;
    }
    return false;
}

function getMilestones($goalId)
{
    $con = getConnection();
    $sql = "SELECT * FROM goal_milestones WHERE goal_id = '$goalId' ORDER BY id ASC";
    $result = mysqli_query($con, $sql);
    $milestones = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $milestones[] = $row;
    }
    return $milestones;
}

function toggleMilestone($milestoneId)
{
    $con = getConnection();
    // First get current state and goal_id
    $sqlGet = "SELECT goal_id, is_completed FROM goal_milestones WHERE id='$milestoneId'";
    $res = mysqli_query($con, $sqlGet);
    $row = mysqli_fetch_assoc($res);

    if ($row) {
        $newState = $row['is_completed'] ? 0 : 1;
        $sqlUpdate = "UPDATE goal_milestones SET is_completed='$newState' WHERE id='$milestoneId'";
        mysqli_query($con, $sqlUpdate);

        updateGoalProgressFromMilestones($row['goal_id']);
        return true;
    }
    return false;
}

function deleteMilestone($milestoneId)
{
    $con = getConnection();
    $sqlGet = "SELECT goal_id FROM goal_milestones WHERE id='$milestoneId'";
    $res = mysqli_query($con, $sqlGet);
    $row = mysqli_fetch_assoc($res);

    if ($row) {
        $sql = "DELETE FROM goal_milestones WHERE id='$milestoneId'";
        mysqli_query($con, $sql);
        updateGoalProgressFromMilestones($row['goal_id']);
        return true;
    }
    return false;
}

function updateGoalProgressFromMilestones($goalId)
{
    $con = getConnection();
    $milestones = getMilestones($goalId);
    $total = count($milestones);

    if ($total == 0) {
        $progress = 0; // Or keep existing? Let's say 0 if no milestones.
    } else {
        $completed = 0;
        foreach ($milestones as $m) {
            if ($m['is_completed'])
                $completed++;
        }
        $progress = round(($completed / $total) * 100);
    }

    $status = ($progress >= 100 && $total > 0) ? 'Completed' : 'Active';

    $sqlUpdate = "UPDATE user_goal SET progress='$progress', status='$status' WHERE id='$goalId'";
    mysqli_query($con, $sqlUpdate);
}
?>