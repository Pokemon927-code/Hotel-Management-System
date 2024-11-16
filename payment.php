<?php
session_start();

// Check if user is logged in; if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Load room data from the session
if (!isset($_SESSION['rooms'])) {
    $_SESSION['rooms'] = [
        ["room_type" => "Single Room", "room_number" => "101", "price" => "100", "status" => "Available"],
        ["room_type" => "Single Room", "room_number" => "103", "price" => "100", "status" => "Available"],
        ["room_type" => "Double Room", "room_number" => "102", "price" => "150", "status" => "Occupied"],
        ["room_type" => "Suite", "room_number" => "201", "price" => "300", "status" => "Available"],
        ["room_type" => "Single Room", "room_number" => "104", "price" => "100", "status" => "Available"],
        ["room_type" => "Double Room", "room_number" => "105", "price" => "150", "status" => "Available"],
        ["room_type" => "Suite", "room_number" => "202", "price" => "300", "status" => "Occupied"],
        ["room_type" => "Single Room", "room_number" => "106", "price" => "100", "status" => "Available"],
        ["room_type" => "Double Room", "room_number" => "107", "price" => "150", "status" => "Occupied"],
        ["room_type" => "Suite", "room_number" => "203", "price" => "300", "status" => "Available"]
    ];
}
$rooms = &$_SESSION['rooms'];

// Process payment form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'];
    $paymentMethod = $_POST['payment_method'];
    $cardNumber = $_POST['card_number'];
    $expiryMonth = $_POST['expiry_month'];
    $expiryYear = $_POST['expiry_year'];
    $cvv = $_POST['cvv'];
    $roomType = $_POST['room_type'];
    $quantity = $_POST['quantity'];

    // Mock payment processing (In a real application, integrate with a payment gateway)
    $paymentStatus = "success"; // This is a placeholder

    if ($paymentStatus === "success") {
        $message = "Payment successful for $quantity $roomType(s)!";

        // Update room status to "Occupied"
        $occupiedRooms = 0;
        foreach ($rooms as &$room) {
            if ($room['room_type'] === $roomType && $room['status'] === 'Available' && $occupiedRooms < $quantity) {
                $room['status'] = 'Occupied';
                $occupiedRooms++;
            }
        }
        unset($room); // Break the reference with the last element
    } else {
        $message = "Payment failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Hotel Management System</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #6a11cb, #2575fc, #3f2b96);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
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
            background-color: #2575fc;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #6a11cb;
        }

        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #fff;
        }

        /* Success/Message text */
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
        <h1>Hotel Management System</h1>
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
        <h2>Payment Information</h2>

        <?php if (isset($message)): ?>
            <p class="<?= $paymentStatus === 'success' ? 'success' : 'error'; ?>"><?php echo $message; ?></p>
        <?php endif; ?>

        <form method="POST">
            <label for="room_type">Room Type:</label>
            <select id="room_type" name="room_type" required>
                <option value="" disabled selected>Select Room Type</option>
                <option value="Single Room">Single Room</option>
                <option value="Double Room">Double Room</option>
                <option value="Suite">Suite</option>
            </select>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required min="1">

            <label for="amount">Amount:</label>
            <input type="text" id="amount" name="amount" value="100" readonly>

            <label for="payment_method">Payment Method:</label>
            <select id="payment_method" name="payment_method" required>
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
            </select>

            <label for="card_number">Card Number:</label>
            <input type="text" id="card_number" name="card_number" required>

            <label for="expiry_month">Expiry Month:</label>
            <select id="expiry_month" name="expiry_month" required>
                <option value="" disabled selected>Month</option>
                <?php for ($m = 1; $m <= 12; $m++): ?>
                    <option value="<?php echo str_pad($m, 2, '0', STR_PAD_LEFT); ?>"><?php echo str_pad($m, 2, '0', STR_PAD_LEFT); ?></option>
                <?php endfor; ?>
            </select>

            <label for="expiry_year">Expiry Year:</label>
            <select id="expiry_year" name="expiry_year" required>
                <option value="" disabled selected>Year</option>
                <?php 
                $currentYear = date('Y');
                for ($y = $currentYear; $y <= $currentYear + 10; $y++): ?>
                    <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                <?php endfor; ?>
            </select><br><br>

            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" required><br><br>

            <button type="submit">Pay</button>
        </form>
    </main>

    <footer>
        <p>© 2024 Hotel Management System</p>
    </footer>
</body>
</html>
