<?php
require_once 'models/db.php';

$con = getConnection();

$sql1 = "ALTER TABLE learning_progress ADD COLUMN total_units INT(11) DEFAULT NULL";
$sql2 = "ALTER TABLE learning_progress ADD COLUMN current_unit INT(11) DEFAULT 0";

if (mysqli_query($con, $sql1)) {
    echo "Added total_units column.<br>";
} else {
    echo "Error adding total_units (or already exists): " . mysqli_error($con) . "<br>";
}

if (mysqli_query($con, $sql2)) {
    echo "Added current_unit column.<br>";
} else {
    echo "Error adding current_unit (or already exists): " . mysqli_error($con) . "<br>";
}
?>
