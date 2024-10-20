<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ev_charging";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID is set in the URL
if (!isset($_GET['id'])) {
    die("Error: ID not provided.");
}

// Get the ID from the URL and ensure it's an integer
$id = intval($_GET['id']);

// Delete the booking
$sql = "DELETE FROM bookings WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    // Redirect with a success message
    header("Location: index.php?message=Slot deleted successfully");
    exit();
}else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
