<?php
$host = 'localhost'; // Database host (usually localhost)
$dbname = 'hotel_management'; // The name of your database
$username = 'root'; // Your database username (default for local server is often 'root')
$password = ''; // Your database password (default for local servers might be empty)

try {
    // Create a new PDO instance for database connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check if the connection was successful
    if ($conn->connect_error) {
       
        die("Connection failed: " . $conn->connect_error);
    }

    // Optionally, you can set the character set to utf8mb4 for better character support
    $conn->set_charset("utf8mb4");

    // You can output a success message or leave it silent (not necessary in production)
    // echo "Connected successfully";

} catch (Exception $e) {
    // Catch any exception that occurs and display an error message
    die("Connection failed: " . $e->getMessage());
}

?>
