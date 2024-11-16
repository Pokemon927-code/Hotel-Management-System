<?php
session_start();

// Check if user is logged in; if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Define an array of images for the gallery
$images = [
    ["src" => "https://images.pexels.com/photos/1581384/pexels-photo-1581384.jpeg?auto=compress&cs=tinysrgb&w=400", "alt" => "Hotel Image 9"],
    ["src" => "https://images.pexels.com/photos/2907196/pexels-photo-2907196.jpeg?auto=compress&cs=tinysrgb&w=600", "alt" => "Hotel Image 10"],
    ["src" => "https://images.pexels.com/photos/244133/pexels-photo-244133.jpeg?auto=compress&cs=tinysrgb&w=600", "alt" => "Hotel Image 4"],
    ["src" => "https://images.pexels.com/photos/1457847/pexels-photo-1457847.jpeg?auto=compress&cs=tinysrgb&w=600", "alt" => "Hotel Image 16"],
    ["src" => "https://images.pexels.com/photos/277572/pexels-photo-277572.jpeg?auto=compress&cs=tinysrgb&w=600", "alt" => "Hotel Image 3"],
    ["src" => "https://images.pexels.com/photos/2034335/pexels-photo-2034335.jpeg?auto=compress&cs=tinysrgb&w=600", "alt" => "Hotel Image 1"],
    ["src" => "https://images.pexels.com/photos/941861/pexels-photo-941861.jpeg?auto=compress&cs=tinysrgb&w=600", "alt" => "Hotel Image 2"],
    ["src" => "https://images.pexels.com/photos/237371/pexels-photo-237371.jpeg?auto=compress&cs=tinysrgb&w=400", "alt" => "Hotel Image 5"],
    ["src" => "https://images.pexels.com/photos/1743231/pexels-photo-1743231.jpeg?auto=compress&cs=tinysrgb&w=400", "alt" => "Hotel Image 6"],
    ["src" => "https://images.pexels.com/photos/261181/pexels-photo-261181.jpeg?auto=compress&cs=tinysrgb&w=400", "alt" => "Hotel Image 7"],
    ["src" => "https://images.pexels.com/photos/1267320/pexels-photo-1267320.jpeg?auto=compress&cs=tinysrgb&w=400", "alt" => "Hotel Image 8"],
    ["src" => "https://images.pexels.com/photos/261169/pexels-photo-261169.jpeg?auto=compress&cs=tinysrgb&w=600", "alt" => "Hotel Image 11"],
    ["src" => "https://images.pexels.com/photos/4825701/pexels-photo-4825701.jpeg?auto=compress&cs=tinysrgb&w=400", "alt" => "Hotel Image 12"],
    ["src" => "https://images.pexels.com/photos/53577/hotel-architectural-tourism-travel-53577.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1", "alt" => "Hotel Image 13"],
    ["src" => "https://images.pexels.com/photos/2507007/pexels-photo-2507007.jpeg?auto=compress&cs=tinysrgb&w=600", "alt" => "Hotel Image 14"],
    ["src" => "https://images.pexels.com/photos/1145257/pexels-photo-1145257.jpeg?auto=compress&cs=tinysrgb&w=600", "alt" => "Hotel Image 15"],
    ["src" => "https://images.pexels.com/photos/1755288/pexels-photo-1755288.jpeg?auto=compress&cs=tinysrgb&w=600", "alt" => "Hotel Image 17"],
    ["src" => "https://images.pexels.com/photos/2291624/pexels-photo-2291624.jpeg?auto=compress&cs=tinysrgb&w=600", "alt" => "Hotel Image 18"],
    ["src" => "https://images.pexels.com/photos/2373201/pexels-photo-2373201.jpeg?auto=compress&cs=tinysrgb&w=600", "alt" => "Hotel Image 19"],
    ["src" => "https://images.pexels.com/photos/290544/pexels-photo-290544.jpeg?auto=compress&cs=tinysrgb&w=600", "alt" => "Hotel Image 20"],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - Hotel Management System</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script>
        // Function to log out
        function logout() {
            window.location.href = "logout.php";
        }
    </script>
    <style>
        body {
            background: linear-gradient(135deg, #FFB6C1, #ADD8E6); /* Pastel pink and light blue gradient */
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            color: white;
        }

        header {
            background-color: #2C3E50;
            padding: 15px;
            text-align: center;
        }

        header nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        header nav ul li {
            display: inline;
            margin-right: 20px;
        }

        header nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        header nav ul li a:hover {
            text-decoration: underline;
        }

        main {
            padding: 50px 20px;
            text-align: center;
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 40px;
            color: #ECF0F1;
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            justify-items: center;
        }

        .gallery img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        footer {
            background-color: #2C3E50;
            color: white;
            text-align: center;
            padding: 15px;
            position: fixed;
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
                <li><a href="#" onclick="logout()">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Gallery</h1>
        <div class="gallery">
            <?php foreach ($images as $image): ?>
                <img src="<?php echo htmlspecialchars($image['src']); ?>" alt="<?php echo htmlspecialchars($image['alt']); ?>">
            <?php endforeach; ?>
        </div>
    </main>

    <footer>
        <p>© 2024 Hotel Management System</p>
    </footer>
</body>
</html>
