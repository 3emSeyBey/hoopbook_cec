<?php
// Include your database connection file here
require_once('../../config.php');

// Prepare the query
if (isset($_GET['court_id'])) {
    $court_id = $_GET['court_id'];
    $stmt = $conn->prepare('SELECT datetime_start, hours FROM court_rentals WHERE court_id = ?');
    $stmt->bind_param('i', $court_id);
} else {
    $stmt = $conn->prepare('SELECT datetime_start, hours FROM court_rentals');
}

// Execute the query
$stmt->execute();

// Get the results
$reservations = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Convert the reservations to a JSON string
echo json_encode($reservations);
