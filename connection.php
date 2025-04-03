<?php
// Database Credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory_alvine"; // Updated to the new database name

// Establish Database Connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check Connection
if ($conn->connect_error) {
    die("⚠️ Sorry Alvine, the database connection failed. Please contact support.");
}
?>
