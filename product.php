<?php
require 'db.php';
require 'functions.php';

$product_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo escape($product['name']); ?></title>
</head>

<body>
    <h1><?php echo escape($product['name']); ?></h1>
    <p><?php echo escape($product['description']); ?></p>
    <p>Price: $<?php echo escape($product['price']); ?></p>
    <img src="<?php echo escape($product['image']); ?>" alt="<?php echo escape($product['name']); ?>">
    <form method="post" action="cart.php">
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
        <input type="number" name="quantity" min="1" value="1" required>
        <button type="submit">Add to Cart</button>
    </form>
    <a href="index.php">Back to Products</a>
</body>

</html>