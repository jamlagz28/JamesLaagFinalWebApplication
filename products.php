<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Handle form submission for adding products
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $customer_id = $_POST['customer_id']; // Get the selected customer ID

    // Insert the new product with the foreign key
    $query = "INSERT INTO products (product_name, price, stock, customer_id) VALUES ('$product_name', '$price', '$stock', '$customer_id')";
    if (mysqli_query($conn, $query)) {
        $success = "Product added successfully!";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}

// Fetch existing products
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

// Fetch customers for the dropdown
$customer_query = "SELECT customer_id, customer_name FROM customers";
$customer_result = mysqli_query($conn, $customer_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <!-- Link to Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Roboto+Slab:wght@400;700&family=Dancing+Script:wght@400&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Roboto Slab', serif; /* Use Roboto Slab for body text */
            background: url('https://img.freepik.com/premium-photo/retro-vintage-background-with-brass-gears-steampunk-style-background-teal-orange-toned_128711-11883.jpg') no-repeat center center fixed;
            background-size: cover;
            color: black; /* Adjust text color for readability */
            margin: 0;
            padding: 0;
        }

        header {
            background: rgba(0, 0, 0, 0.7); /* Semi-transparent background for header */
            color: white;
            padding: 20px;
            text-align: center;
            font-family: 'Poppins', sans-serif; /* Use Poppins for header */
        }

        h1 {
            font-size: 2.5rem; /* Larger header */
            font-weight: 600;
            font-family: 'Dancing Script', cursive; /* Unique cursive font for the main header */
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: 600;
            font-size: 1.1rem;
        }

        nav a:hover {
            text-decoration: underline;
        }

        h2 {
            text-align: center;
            font-size: 2rem;
            margin-top: 20px;
            font-family: 'Poppins', sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: rgba(255, 255, 255, 0.8); /* Light background for the table */
            border-radius: 8px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
            font-size: 1.1rem;
        }

        th {
            background-color: #333;
            color: white;
            font-weight: 700;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        form {
            background: rgba(255, 255, 255, 0.9); /* Semi-transparent white for the form */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-family: 'Roboto Slab', serif; /* Form uses Roboto Slab */
        }

        input, select {
            width: calc(100% - 22px);
            padding: 12px;
            margin: 12px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background: #28a745;
            color: white;
            border: none;
            padding: 12px;
            cursor: pointer;
            border-radius: 5px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif; /* Button text in Poppins */
        }

        button:hover {
            background: #218838;
        }

        .logout {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            background: darkred;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
        }

        .logout:hover {
            background: #c82333;
        }

        .join-links {
            text-align: center;
            margin-bottom: 20px;
        }

        .join-links a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            font-size: 1.2rem;
            font-weight: 500;
        }

        .join-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Products Management</h1>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="products.php">Products</a>
            <a href="customers.php">Customers</a>
            <a class="logout" href="logout.php">Logout</a>
        </nav>
    </header>
    
    <main>
        <h2>Add New Product</h2>
        <form method="POST" action="">
            <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
            <input type="text" name="product_name" placeholder="Product Name" >
            <input type="number" name="price" placeholder="Price" step="0.01" >
            <input type="number" name="stock" placeholder="Quantity" >
            <select name="customer_id" required>
                <option value="">Select Customer</option>
                <?php while ($customer_row = mysqli_fetch_assoc($customer_result)): ?>
                    <option value="<?php echo htmlspecialchars($customer_row['customer_id']); ?>">
                        <?php echo htmlspecialchars($customer_row['customer_name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <button type="submit">Add Product</button>
        </form>

        <h2>Existing Products</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Customer ID</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['product_id']); ?></td>
                <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                <td><?php echo htmlspecialchars($row['price']); ?></td>
                <td><?php echo htmlspecialchars($row['stock']); ?></td>
                <td><?php echo htmlspecialchars($row['customer_id']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </main>
</body>
</html>
