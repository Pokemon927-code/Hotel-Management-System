<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Hotel Management System</title>
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
            width: 100%;
        }

        nav ul.nav-bar {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        nav ul.nav-bar li {
            margin: 0 15px;
        }

        nav ul.nav-bar li a {
            color: white;
            text-decoration: none;
            font-size: 1.2rem;
        }

        nav ul.nav-bar li a:hover {
            text-decoration: underline;
        }

        main {
            flex-grow: 1;
            text-align: center;
            padding: 50px 20px;
            color: #333;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 1.8rem;
            margin-top: 30px;
        }

        p {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 20px 0;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        ul li {
            padding: 5px 0;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
            position: relative;
            bottom: 0;
            width: 100%;
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
        <h1>About Us</h1>
        <p>Welcome to our hotel, where luxury meets comfort. Established in 2000, our hotel has been providing top-notch services to guests from all over the world. Located in the heart of the city, we offer a perfect blend of modern amenities and traditional hospitality.</p>
        
        <h2>Our hotel features:</h2>
        <ul>
            <li>Spacious and well-appointed rooms with stunning city views</li>
            <li>24/7 room service and concierge</li>
            <li>State-of-the-art fitness center and spa</li>
            <li>Multiple dining options offering a variety of cuisines</li>
            <li>Conference and banquet facilities for all your event needs</li>
            <li>Complimentary high-speed Wi-Fi</li>
        </ul>
        
        <p>Our dedicated staff is committed to ensuring that your stay is comfortable and memorable. Whether you are here for business or leisure, we strive to provide an exceptional experience for all our guests.</p>
    </main>

    <footer>
        <p>© 2024 Hotel Management System</p>
    </footer>
</body>
</html>
