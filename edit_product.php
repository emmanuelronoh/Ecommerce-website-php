<?php
require 'db.php';
require 'functions.php';

$product_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = escape($_POST['name']);
    $description = escape($_POST['description']);
    $price = $_POST['price'];
    $image = escape($_POST['image']);

    $stmt = $pdo->prepare("UPDATE products SET name = ?, description = ?, price = ?, image = ? WHERE id = ?");
    $stmt->execute([$name, $description, $price, $image, $product_id]);
    redirect('dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 80%;
        max-width: 600px;
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

    input,
    textarea {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
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
        <h1>Edit Product</h1>
        <form method="post">
            <input type="text" name="name" value="<?php echo escape($product['name']); ?>" required>
            <textarea name="description" required><?php echo escape($product['description']); ?></textarea>
            <input type="number" step="0.01" name="price" value="<?php echo escape($product['price']); ?>" required>
            <input type="text" name="image" value="<?php echo escape($product['image']); ?>" required>
            <button type="submit">Update Product</button>
        </form>
        <a href="dashboard.php" class="back-link">Back to Dashboard</a>
    </div>
</body>

</html>