<?php
session_start();
require 'db.php';
require 'functions.php';

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    redirect('login.php');
}

// Admin functionalities

// Fetch products
$productsQuery = $pdo->query("SELECT * FROM products");
$products = $productsQuery->fetchAll();

// Fetch users
$usersQuery = $pdo->query("SELECT * FROM users");
$users = $usersQuery->fetchAll();

// Fetch orders
$ordersQuery = $pdo->query("SELECT * FROM orders");
$orders = $ordersQuery->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 8px 12px;
        border: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }
    </style>
</head>

<body>
    <h1>Admin Dashboard</h1>
    <h2>Manage Products</h2>
    <a href="add_product.php">Add New Product</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo escape($product['id']); ?></td>
            <td><?php echo escape($product['name']); ?></td>
            <td><?php echo escape($product['description']); ?></td>
            <td>$<?php echo escape($product['price']); ?></td>
            <td>
                <a href="edit_product.php?id=<?php echo $product['id']; ?>">Edit</a>
                <a href="delete_product.php?id=<?php echo $product['id']; ?>"
                    onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Manage Users</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo escape($user['id']); ?></td>
            <td><?php echo escape($user['username']); ?></td>
            <td><?php echo escape($user['created_at']); ?></td>
            <td>
                <a href="delete_user.php?id=<?php echo $user['id']; ?>"
                    onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Manage Orders</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Total</th>
            <th>Created At</th>
        </tr>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td><?php echo escape($order['id']); ?></td>
            <td><?php echo escape($order['user_id']); ?></td>
            <td>$<?php echo escape($order['total']); ?></td>
            <td><?php echo escape($order['created_at']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <a href="index.php">Back to Store</a>
</body>

</html>