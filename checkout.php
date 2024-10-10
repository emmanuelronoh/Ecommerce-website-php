<?php
session_start();
require 'db.php';
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['user_id'])) {
        redirect('login.php'); // Ensure user is logged in
    }

    $user_id = $_SESSION['user_id'];
    $total = 0;

    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $stmt = $pdo->prepare("SELECT price FROM products WHERE id = ?");
        $stmt->execute([$product_id]);
        $product = $stmt->fetch();
        $total += $product['price'] * $quantity;
    }

    // Insert order
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, total) VALUES (?, ?)");
    $stmt->execute([$user_id, $total]);
    $order_id = $pdo->lastInsertId();

    // Insert order items
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->execute([$order_id, $product_id, $quantity]);
    }

    // Clear cart
    unset($_SESSION['cart']);
    redirect('index.php');
}

$total = isset($total) ? $total : 0; // Initialize total for display
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 80%;
        max-width: 500px;
        margin: 50px auto;
        padding: 20px;
        background: white;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
    }

    p {
        text-align: center;
        font-size: 1.2em;
        color: #555;
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1em;
    }

    button:hover {
        background-color: #0056b3;
    }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #007bff;
        text-decoration: none;
    }

    .back-link:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Checkout</h1>
        <form method="post">
            <p>Total: $<?php echo number_format($total, 2); ?></p>
            <button type="submit">Confirm Order</button>
        </form>
        <a href="cart.php" class="back-link">Back to Cart</a>
    </div>
</body>

</html>