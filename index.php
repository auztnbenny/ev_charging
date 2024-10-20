<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EV Charging Station Slot Booking</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->
    <nav>
        <div class="logo">
            <h1>EV Charging Station</h1>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="#stations">Charging Stations</a></li>
            <li><a href="#book">Book</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </nav>

    <!-- Display success message if available -->
    <?php if (isset($_GET['message'])): ?>
        <div class="success-message"><?php echo htmlspecialchars($_GET['message']); ?></div>
    <?php endif; ?>

    <!-- Home Section -->
    <section id="home" class="section">
        <h2>Welcome to the EV Charging Station Slot Booking</h2>
        <p>Book your slot with ease and manage your bookings.</p>
    </section>

    <!-- Charging Stations Section -->
    <section id="stations" class="section">
        <h2>Charging Stations</h2>
        <p>Find the nearest EV charging stations around you.</p>
    </section>

    <!-- Booking Section -->
    <section id="book" class="section">
        <h2>Book a Charging Slot</h2>
        <form action="booking.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="vehicle_number">Vehicle Number:</label>
            <input type="text" id="vehicle_number" name="vehicle_number" required>
            
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="slot_time">Time:</label>
            <input type="time" id="slot_time" name="slot_time" required>

            <input type="submit" value="Book Slot">
        </form>

        <h3>Booked Slots</h3>
        <div id="booked-slots">
            <!-- PHP code to fetch and display booked slots -->
            <?php
            // Include the database connection file
            include 'db_connection.php';

            // Fetch booked slots from the database
            $sql = "SELECT * FROM bookings";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='booked-slot'>";
                    echo "<p>Name: " . htmlspecialchars($row['name']) . "</p>";
                    echo "<p>Vehicle Number: " . htmlspecialchars($row['vehicle_number']) . "</p>";
                    echo "<p>Date: " . htmlspecialchars($row['date']) . "</p>"; // Displaying the date
                    echo "<p>Time: " . htmlspecialchars($row['slot_time']) . "</p>";
                    echo "<a href='edit.php?id=" . $row['id'] . "' class='edit'>Edit</a>";
                    echo "<a href='delete.php?id=" . $row['id'] . "' class='delete'>Delete</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>No booked slots available.</p>";
            }

            $conn->close();
            ?>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section">
        <h2>Contact Us</h2>
        <p>If you have any questions or concerns, feel free to reach out.</p>
    </section>

    <script src="app.js"></script>
</body>
</html>