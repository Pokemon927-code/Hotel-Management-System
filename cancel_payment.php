<?php
session_start();

// Check if the user is logged in; if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Load room data from a session or initialize if not present
if (!isset($_SESSION['rooms'])) {
    $_SESSION['rooms'] = [
        ["room_type" => "Single Room", "room_number" => "101", "price" => "100", "status" => "Available"],
        ["room_type" => "Single Room", "room_number" => "102", "price" => "100", "status" => "Occupied"],
        ["room_type" => "Single Room", "room_number" => "103", "price" => "100", "status" => "Available"],
        ["room_type" => "Single Room", "room_number" => "104", "price" => "100", "status" => "Occupied"],
        
        ["room_type" => "Double Room", "room_number" => "201", "price" => "150", "status" => "Available"],
        ["room_type" => "Double Room", "room_number" => "202", "price" => "150", "status" => "Occupied"],
        ["room_type" => "Double Room", "room_number" => "203", "price" => "150", "status" => "Available"],
        
        ["room_type" => "Suite", "room_number" => "301", "price" => "300", "status" => "Available"],
        ["room_type" => "Suite", "room_number" => "302", "price" => "300", "status" => "Occupied"],
        ["room_type" => "Suite", "room_number" => "303", "price" => "300", "status" => "Available"]
    ];
}

$rooms = &$_SESSION['rooms']; // Reference to session rooms

// Process cancellation form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_payment'])) {
    $roomType = $_POST['room_type'];
    $quantity = $_POST['quantity'];

    $cancelledRooms = 0;

    // Update room status to "Available"
    foreach ($rooms as &$room) {
        if ($room['room_type'] === $roomType && $room['status'] === 'Occupied' && $cancelledRooms < $quantity) {
            $room['status'] = 'Available';
            $cancelledRooms++;
        }
    }
    unset($room); // Break reference with the last element

    $cancelMessage = "$cancelledRooms $roomType(s) have been successfully cancelled and set to 'Available'.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Payment - Hotel Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #FFD700, #FF5733, #C70039, #900C3F); /* Gradient with warm golds and reds */
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite; /* Smooth background animation */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #fff;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        header {
            text-align: center;
            margin-bottom: 20px;
            width: 100%;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: center; /* Center the links horizontally */
            display: flex; /* Use flexbox for horizontal alignment */
            justify-content: center; /* Center the links in the container */
            flex-wrap: wrap; /* Ensure links wrap on smaller screens */
        }

        nav ul li {
            margin: 0 15px; /* Space between the links */
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.2);
            transition: background-color 0.3s ease;
            display: inline-block;
        }

        nav ul li a:hover {
            background-color: rgba(255, 255, 255, 0.5);
        }

        main {
            background: rgba(0, 0, 0, 0.7); /* Semi-transparent background for the form */
            padding: 30px;
            border-radius: 8px;
            max-width: 500px;
            width: 100%;
            text-align: left;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        h1, h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: stretch;
        }

        form label {
            font-size: 18px;
            font-weight: bold;
        }

        form input, form select, form button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            margin: 5px 0;
        }

        button {
            background-color: #FF5733; /* Warm red color */
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #C70039; /* Darker red on hover */
        }

        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #fff;
        }

        p {
            font-size: 16px;
            font-weight: bold;
            color: green;
        }

        p.error {
            color: red;
        }

        @media (max-width: 600px) {
            main {
                padding: 20px;
                max-width: 90%;
            }

            form label {
                font-size: 16px;
            }

            form input, form select, form button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul class="nav-bar">
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="rooms.php">Rooms</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="payment.php">Payment</a></li>
                <li><a href="cancel_payment.php">Cancel Payment</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Cancel Payment</h1>
        
        <?php
        // Display cancellation message if available
        if (isset($cancelMessage)) {
            echo "<p style='color:green;'>$cancelMessage</p>";
        }
        ?>
        
        <form method="POST" action="">
            <label for="room_type">Room Type:</label>
            <select id="room_type" name="room_type" required>
                <?php foreach (array_unique(array_column($rooms, 'room_type')) as $type): ?>
                    <option value="<?php echo htmlspecialchars($type); ?>"><?php echo htmlspecialchars($type); ?></option>
                <?php endforeach; ?>
            </select><br><br>
            
            <label for="quantity">Quantity to Cancel:</label>
            <input type="number" id="quantity" name="quantity" min="1" max="5" required><br><br>

            <button type="submit" name="cancel_payment">Cancel Payment</button>
        </form>
    </main>

    <footer>
        <p>© 2024 Hotel Management System</p>
    </footer>
</body>
</html>
