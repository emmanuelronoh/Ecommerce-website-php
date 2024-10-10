<?php
require 'db.php';
require 'functions.php';

// Fetch products from the database
$query = $pdo->query("SELECT * FROM products");
$products = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple E-commerce Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 90%;
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    .links {
        text-align: center;
        margin: 20px 0;
    }

    .links a {
        margin: 0 15px;
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
    }

    .links a:hover {
        text-decoration: underline;
    }

    h2 {
        color: #555;
        margin-top: 30px;
        text-align: center;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .product {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .product:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }

    .product h3 {
        color: #333;
        margin: 10px 0;
    }

    .product p {
        color: #666;
        margin: 5px 0;
    }

    .product a {
        display: block;
        text-align: center;
        margin-top: 10px;
        padding: 10px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.2s;
    }

    .product a:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to the E-commerce Store</h1>
        <div class="links">
            <a href="register.php">Register</a> |
            <a href="login.php">Login</a> |
            <a href="cart.php">Cart</a> |
            <a href="dashboard.php">Dashboard</a>
        </div>

        <h2>Products</h2>
        <div class="product-grid">
            <?php foreach ($products as $product): ?>
            <div class="product">
                <h3><?php echo escape($product['name']); ?></h3>
                <p><?php echo escape($product['description']); ?></p>
                <p>Price: $<?php echo number_format($product['price'], 2); ?></p>
                <img src="<?php echo escape($product['image']); ?>" alt="<?php echo escape($product['name']); ?>">
                <a href="product.php?id=<?php echo $product['id']; ?>">View Product</a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>