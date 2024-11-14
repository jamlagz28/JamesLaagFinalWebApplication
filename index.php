<?php
session_start();
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM register WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid credentials!";
        }
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Add Google Fonts link for custom fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Global Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('https://c8.alamy.com/comp/T2BN3W/many-auto-parts-on-white-background-3d-illustration-T2BN3W.jpg') no-repeat center center fixed; 
            background-size: cover;
            background-position: center;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.8); /* Slightly opaque background */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 380px;
        }

        h2 {
            text-align: center;
            font-family: 'Open Sans', sans-serif;
            color: #333;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .input-field {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 2px solid #ccc;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .input-field:focus {
            border-color: #ff5f6d;
            outline: none;
        }

        .button {
            width: 100%;
            padding: 15px;
            background-color: #ff5f6d;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #ff3b47;
        }

        .error-message {
            color: #e74c3c;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        p {
            text-align: center;
            font-size: 14px;
        }

        a {
            color: #ff5f6d;
            text-decoration: none;
            font-weight: 600;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Responsive design */
        @media screen and (max-width: 480px) {
            .login-container {
                padding: 30px;
            }
            .input-field, .button {
                font-size: 14px;
            }
        }

    </style>
</head>
<body>

    <div class="login-container">
    
        <h2>Login</h2>
        <?php if (isset($error)) echo "<p class='error-message'>$error</p>"; ?>

        <form method="POST" action="">
            <input type="text" name="username" class="input-field" placeholder="Username" required>
            <input type="password" name="password" class="input-field" placeholder="Password" required>
            <button type="submit" class="button">Login</button>
        </form>
        
        <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
    </div>

</body>
</html>
