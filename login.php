<?php
// login.php
session_start();
require_once 'database.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SQL query to fetch the user
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username); // Bind parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Fetch the user from the result
        $user = $result->fetch_assoc();
        // Check if the password is correct (using password_verify for hashing)
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id']; // Store user ID in session
            header("Location: home.php"); // Redirect to home page
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hotel Management System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(45deg, #FFB6C1, #FFD700, #00BFFF, #FF69B4);
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

        main {
            flex-grow: 1;
            padding: 20px;
            text-align: center;
            color: #333;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: inline-block;
            background-color: #f0f8ff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        form label {
            font-size: 1.2rem;
            margin: 10px 0;
            display: block;
            text-align: left;
        }

        form input {
            width: 100%;
            padding: 15px;
            margin: 10px 0 20px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 1.2rem;
            box-sizing: border-box;
        }

        button {
            padding: 12px 25px;
            font-size: 1.1rem;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        p {
            font-size: 1rem;
            margin-top: 10px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
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

        .error {
            color: red;
            font-size: 1.2rem;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Hotel Management System</h1>
    </header>
    
    <main>
        <h2>Login</h2>
        <form method="POST" action="login.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            
            <button type="submit">Login</button>
            
            <?php if ($error != "") { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
        </form>
        
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </main>
    
    <footer>
        <p>© 2024 Hotel Management System </p>
    </footer>
</body>
</html>
