<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Handle form submission for adding customers
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $register_id = $_POST['register_id']; // Get the selected register ID

    // Insert the new customer with the foreign key
    $query = "INSERT INTO customers (customer_name, email, register_id) VALUES ('$customer_name', '$email', '$register_id')";
    if (mysqli_query($conn, $query)) {
        $success = "Customer added successfully!";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}

// Fetch existing customers
$query = "SELECT * FROM customers";
$result = mysqli_query($conn, $query);

// Fetch register users for the dropdown
$register_query = "SELECT register_id, username FROM register";
$register_result = mysqli_query($conn, $register_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customers</title>
    <!-- Add Google Fonts link for custom font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif; /* Apply Poppins font */
            background: url('https://thumbs.dreamstime.com/z/cogs-gears-industrial-business-background-background-integration-technology-banner-background-vector-illustration-vector-180795467.jpg?w=768') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            color: #333; /* Adjust text color for readability */
        }

        header {
            background: rgba(0, 0, 0, 0.7); /* Semi-transparent background for the header */
            color: white;
            padding: 15px;
            text-align: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: 500; /* Make the navigation links bold */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: rgba(255, 255, 255, 0.8); /* Light background for the table */
            font-weight: 400; /* Regular font weight for table text */
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: black;
            color: white;
            font-weight: 600; /* Make header text bold */
        }

        form {
            background: rgba(255, 255, 255, 0.9); /* Semi-transparent white for the form */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-weight: 400; /* Regular font weight for form text */
        }

        input, select {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-family: 'Poppins', sans-serif; /* Make sure input fields use the custom font */
        }

        button {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            font-family: 'Poppins', sans-serif; /* Apply custom font to buttons */
        }

        button:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <header>
        <h1>Customers Management</h1>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="products.php">Products</a>
            <a href="customers.php">Customers</a>
            <a class="logout" href="logout.php">Logout</a>
        </nav>
    </header>
    
    <main>
        <h2>Add New Customer</h2>
        <form method="POST" action="">
            <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
            <input type="text" name="customer_name" placeholder="Customer Name" >
            <input type="email" name="email" placeholder="Email" >
            <select name="register_id" required>
                <option value="">Select User</option>
                <?php while ($register_row = mysqli_fetch_assoc($register_result)): ?>
                    <option value="<?php echo htmlspecialchars($register_row['register_id']); ?>">
                        <?php echo htmlspecialchars($register_row['username']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <button type="submit">Add Customer</button>
        </form>

        <h2>Existing Customers</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Register ID</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['customer_id']); ?></td>
                <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['register_id']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </main>
</body>
</html>
