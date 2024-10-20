<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ev_charging";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the ID from the URL
$id = $_GET['id'];

// Fetch the current booking details
$sql = "SELECT * FROM bookings WHERE id=$id";
$result = $conn->query($sql);
$booking = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $vehicle_number = $_POST['vehicle_number'];
    $date = $_POST['date'];
    $slot_time = $_POST['slot_time'];

    // Update the database
    $update_sql = "UPDATE bookings SET name='$name', vehicle_number='$vehicle_number', date='$date', slot_time='$slot_time' WHERE id=$id";

    if ($conn->query($update_sql) === TRUE) {
        header("Location: index.php?message=Slot updated successfully");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <link rel="stylesheet" href="style.css"> <!-- Include your CSS for styling -->
</head>
<body>
    <h2>Edit Your Booking</h2>
    <form method="POST" action="">
        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($booking['name']); ?>" required>

        <label for="vehicle_number">Vehicle Number:</label>
        <input type="text" id="vehicle_number" name="vehicle_number" value="<?php echo htmlspecialchars($booking['vehicle_number']); ?>" required>

        <label for="date">Select Date:</label>
        <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($booking['date']); ?>" required>

        <label for="slot_time">Select Time:</label>
        <input type="time" id="slot_time" name="slot_time" value="<?php echo htmlspecialchars($booking['slot_time']); ?>" required>

        <button type="submit">Update Slot</button>
    </form>
    <style>
        /* Add some unique styles for the edit form */
        body {
            background-color: #f0f8ff;
        }
        h2 {
            color: #333;
        }
        form {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 20px auto;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</body>
</html>