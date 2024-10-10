<?php
require 'db.php';
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = escape($_POST['name']);
    $description = escape($_POST['description']);
    $price = $_POST['price'];
    $image = escape($_POST['image']); // Assuming the image URL or path

    $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $description, $price, $image]);
    redirect('dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
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
        <h1>Add New Product</h1>
        <form method="post">
            <input type="text" name="name" placeholder="Product Name" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <input type="number" step="0.01" name="price" placeholder="Price" required>
            <input type="text" name="image" placeholder="Image URL" required>
            <button type="submit">Add Product</button>
        </form>
        <a href="dashboard.php" class="back-link">Back to Dashboard</a>
    </div>
</body>

</html>