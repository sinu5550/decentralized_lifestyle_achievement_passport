<?php
require_once('db.php');

$con = getConnection();

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = file_get_contents(__DIR__ . '/diary.sql');

if (!$sql) {
    die("Failed to read SQL file");
}


if (mysqli_multi_query($con, $sql)) {
    do {
        if ($result = mysqli_store_result($con)) {
            mysqli_free_result($result);
        }
    } while (mysqli_next_result($con));
    echo "Diary table created successfully!";
} else {
    echo "Error creating table: " . mysqli_error($con);
}
?>