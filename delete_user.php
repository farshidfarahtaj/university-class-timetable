<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
}

$user_id = $_GET['id'];

$sql = "DELETE FROM users WHERE id='$user_id'";

if ($conn->query($sql) === TRUE) {
    header("Location: manage_users.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>