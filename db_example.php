<?php
// Rename this file to db.php and update with your database credentials
$servername = "localhost";
$username = "your_db_username";
$password = "your_db_password";
$dbname = "university_timetable";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?> 