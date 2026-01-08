<?php

function dbConnection()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lifestyle_passport"; // CHANGE THIS IF YOUR DB NAME IS DIFFERENT

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $conn;
}
?>