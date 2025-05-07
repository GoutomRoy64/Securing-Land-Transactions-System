<?php
// Database credentials
$servername = "mysql.railway.internal";    // Hostname (usually localhost)
$username = "root";           // Default username for local server
$password = "fndKpcivHgmAixxvEnWRElJwBokEfdFz";               // Default password (empty in XAMPP/MAMP by default)
$dbname = "fndKpcivHgmAixxvEnWRElJwBokEfdFz"; // Your database name (replace with yours)

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
