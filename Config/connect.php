<?php
// Database credentials
$servername = "localhost";    // Hostname (usually localhost)
$username = "root";           // Default username for local server
$password = "";               // Default password (empty in XAMPP/MAMP by default)
$dbname = "securing land transactions system_db"; // Your database name (replace with yours)

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Uncomment this to confirm the connection works
// echo "Connected successfully!";






// include('../config/connect.php');
// Now $conn is ready to use!
?>
