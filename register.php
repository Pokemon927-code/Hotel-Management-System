<?php
// register.php
session_start();
require_once 'database.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Check if the username or email already exists
    $query = "SELECT * FROM users WHERE email = ? OR username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // User already exists
        $error = "Username or Email already exists. Please choose another.";
    } else {
        // Insert the new user into the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
        $insert_query = "INSERT INTO users (email, username, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("sss", $email, $username, $hashed_password);
        
        if ($stmt->execute()) {
            $success = "Registration successful! You can now log in.";
            header("Location: login.php"); // Redirect to login page after successful registration
            exit();
        } else {
            $error = "There was an error during registration. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Hotel Management System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(to right, #00c6ff, #0072ff, #00b09b, #96c93d);
    background-size: 400% 400%;
    animation: gradientAnimation 15s ease infinite;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

@keyframes gradientAnimation {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}


        header {
            text-align: center;
            padding: 20px;
            color: white;
            background-color: rgba(0, 0, 0, 0.7);
            width: 100%;
        }

        h1 {
            font-size: 3rem;
        }

        main {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 8px;
            width: 400px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-size: 1.1rem;
            margin-bottom: 5px;
            display: block;
            text-align: left;
            margin-left: 20px;
        }

        input[type="email"],
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1rem;
            background-color: #f9f9f9;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #6a11cb;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #ff6a00;
        }

        .error,
        .success {
            font-size: 1.1rem;
            margin: 10px 0;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            width: 100%;
            position: fixed;
            bottom: 0;
        }
    </style>
</head>
<body>

    <header>
        <h1>Hotel Management System</h1>
    </header>

    <main>
        <h2>Register</h2>
        <form method="POST" action="register.php">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            
            <button type="submit">Register</button>
            
            <?php if ($error != "") { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
            <?php if ($success != "") { ?>
                <p class="success"><?php echo $success; ?></p>
            <?php } ?>
        </form>
        
        <p>Already have an account? <a href="login.php">Sign In</a></p>
    </main>

    <footer>
        <p>© 2024 Hotel Management System</p>
    </footer>

</body>
</html>
