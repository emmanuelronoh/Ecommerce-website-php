<?php
require 'functions.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $_SESSION['cart'][$product_id] = $quantity;
}

$cart_items = $_SESSION['cart'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
</head>

<body>
    <h1>Your Shopping Cart</h1>
    <table>
        <tr>
            <th>Product ID</th>
            <th>Quantity</th>
        </tr>
        <?php foreach ($cart_items as $id => $quantity): ?>
        <tr>
            <td><?php echo escape($id); ?></td>
            <td><?php echo escape($quantity); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="checkout.php">Proceed to Checkout</a>
    <a href="index.php">Continue Shopping</a>
</body>

</html>