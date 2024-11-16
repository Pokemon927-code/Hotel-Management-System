<?php
session_start();

// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Initialize variables for form data and messages
$name = $email = $message = "";
$success_message = $error_message = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize input values
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Basic validation (can be expanded as needed)
    if (!empty($name) && !empty($email) && !empty($message)) {
        // For demonstration purposes, we display a success message.
        // In a real application, you might store the message in a database or send an email.
        $success_message = "Message sent successfully!";
    } else {
        $error_message = "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Hotel Management System</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #A8E6CF, #F1F1F1); /* Minty fresh and soft cream background */
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        header {
            width: 100%;
            padding: 10px 0;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: center;
        }

        nav ul li {
            display: inline;
            margin: 0 15px;
        }

        nav ul li a {
            color: #333;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
            border-radius: 5px;
        }

        nav ul li a:hover {
            background-color: #A8E6CF;
        }

        main {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 8px;
            width: 100%;
            max-width: 600px;
            text-align: center;
            box-sizing: border-box;
        }

        h1 {
            font-size: 2em;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-size: 18px;
            margin-bottom: 10px;
            text-align: left;
            width: 100%;
        }

        input, textarea {
            width: 80%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #A8E6CF; /* Minty fresh color */
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #A1D3B2; /* Slightly darker mint on hover */
        }

        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #333;
        }

        p.success {
            color: green;
            font-size: 18px;
        }

        p.error {
            color: red;
            font-size: 18px;
        }

        @media (max-width: 600px) {
            form {
                width: 90%;
            }
            input, textarea {
                width: 100%;
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
        <h1>Contact Us</h1>

        <!-- Display success or error messages -->
        <?php if (!empty($success_message)): ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php elseif (!empty($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <!-- Contact Form -->
        <form method="POST" action="">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($name); ?>"><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email); ?>"><br><br>

            <label for="message">Message:</label>
            <textarea id="message" name="message" required><?php echo htmlspecialchars($message); ?></textarea><br><br>

            <button type="submit">Send Message</button>
        </form>
    </main>

    <footer>
        <p>© 2024 Hotel Management System</p>
    </footer>
</body>
</html>
