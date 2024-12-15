<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "foodiecorner";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete franchise
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM franchise WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header('Location: dashboard.php');
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
