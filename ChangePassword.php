<?php

// Assuming you are using MySQL, you need to provide your database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hoopbook_db";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the password and ID from the POST request
$password = $_POST['password'];
$id = $_POST['id'];

// Prepare the SQL statement to update the password
$sql = "UPDATE accounts SET password = '$password' WHERE id = '$id'";

// Execute the SQL statement
if ($conn->query($sql) === TRUE) {
    echo "Password updated successfully";
} else {
    echo "Error updating password: " . $conn->error;
}

// Close the database connection
$conn->close();