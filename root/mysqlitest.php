<!DOCTYPE html>
<html>
<body>

<h1>My first PHP page</h1>

<?php
$servername = "localhost";
$username = "root";
$password = "1234";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>

</body>
</html>