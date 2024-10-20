<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $vehicle_number = $_POST['vehicle_number'];
    $date = $_POST['date'];
    $slot_time = $_POST['slot_time'];

    // Insert the booking into the database
    $sql = "INSERT INTO bookings (name, vehicle_number, date, slot_time) VALUES ('$name', '$vehicle_number', '$date', '$slot_time')";

    if ($conn->query($sql) === TRUE) {
        // Redirect with a success message
        header("Location: index.php?message=Slot booked successfully");
        exit();
    }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
