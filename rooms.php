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
        // Single Rooms
        ["room_type" => "Single Room", "room_number" => "101", "price" => "100", "status" => "Available"],
        ["room_type" => "Single Room", "room_number" => "102", "price" => "100", "status" => "Occupied"],
        ["room_type" => "Single Room", "room_number" => "103", "price" => "100", "status" => "Available"],
        ["room_type" => "Single Room", "room_number" => "104", "price" => "100", "status" => "Occupied"],
        
        // Double Rooms
        ["room_type" => "Double Room", "room_number" => "201", "price" => "150", "status" => "Available"],
        ["room_type" => "Double Room", "room_number" => "202", "price" => "150", "status" => "Occupied"],
        ["room_type" => "Double Room", "room_number" => "203", "price" => "150", "status" => "Available"],
        
        // Suites
        ["room_type" => "Suite", "room_number" => "301", "price" => "300", "status" => "Available"],
        ["room_type" => "Suite", "room_number" => "302", "price" => "300", "status" => "Occupied"],
        ["room_type" => "Suite", "room_number" => "303", "price" => "300", "status" => "Available"]
    ];
}

$rooms = $_SESSION['rooms'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms - Hotel Management System</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #ff7e5f, #feb47b, #ff6a00, #f7b731, #6a11cb);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        header {
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 15px 0;
            text-align: center;
        }

        header nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        header nav ul li {
            margin: 0 15px;
        }

        header nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        header nav ul li a:hover {
            text-decoration: underline;
        }

        main {
            flex-grow: 1;
            padding: 20px;
            text-align: center;
            color: #333;
        }

        h1, h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        #categories-container {
            margin-bottom: 40px;
        }

        .room-category {
            cursor: pointer;
            color: #007bff;
            text-decoration: underline;
            font-size: 1.2rem;
            margin: 10px 0;
        }

        .room-category:hover {
            color: #0056b3;
        }

        #rooms-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            justify-items: center;
        }

        .room {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: left;
            width: 100%;
            transition: transform 0.3s ease;
        }

        .room:hover {
            transform: translateY(-10px);
        }

        .room h3 {
            font-size: 1.5rem;
            color: #333;
        }

        .room p {
            margin: 5px 0;
            color: #555;
        }

        .room p.price {
            font-weight: bold;
            color: #28a745;
        }

        .room p.status {
            color: #dc3545;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
        }

        footer a {
            color: #007bff;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
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
        <h1>Room Categories</h1>
        <div id="categories-container">
            <?php
            $roomTypes = array_unique(array_column($rooms, 'room_type'));
            foreach ($roomTypes as $type): ?>
                <p class="room-category" onclick="showRooms('<?php echo $type; ?>')">
                    <?php echo htmlspecialchars($type); ?>
                </p>
            <?php endforeach; ?>
        </div>

        <h2>Available Rooms</h2>
        <div id="rooms-container">
            <?php foreach ($rooms as $room): ?>
                <div class="room" data-room-type="<?php echo htmlspecialchars($room['room_type']); ?>">
                    <h3><?php echo htmlspecialchars($room['room_type']); ?></h3>
                    <p>Room Number: <?php echo htmlspecialchars($room['room_number']); ?></p>
                    <p class="price">Price: $<?php echo htmlspecialchars($room['price']); ?> per night</p>
                    <p class="status">Status: <?php echo htmlspecialchars($room['status']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer>
        <p>© 2024 Hotel Management System </p>
    </footer>
</body>
</html>
