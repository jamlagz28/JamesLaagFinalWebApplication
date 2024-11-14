<?php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];

    $query = "INSERT INTO register (username, password, email) VALUES ('$username', '$password', '$email')";
    if (mysqli_query($conn, $query)) {
        $success = "Registration successful!";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input {
            width: 97%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background: #0056b3;
        }
        h2 {
            text-align: center;
        }
         
    </style>
</head>
<body>
    <form method="POST" action="">
        <h2>Register</h2>
        <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Register</button>
        <p>Already have an account? <a href="index.php">Login here</a>.</p>
    </form>
</body>
</html>
