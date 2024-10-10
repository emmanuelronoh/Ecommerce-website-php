<?php
session_start();
require 'db.php';
require 'functions.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = escape($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role']; // Assuming role is stored in the database
        redirect('index.php');
    } else {
        $error = "Invalid credentials. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        width: 300px;
        padding: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
        font-size: 24px;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
        transition: border-color 0.3s;
    }

    input:focus {
        border-color: #007bff;
        outline: none;
    }

    button {
        width: 100%;
        padding: 12px;
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }

    .error {
        color: red;
        text-align: center;
        margin: 10px 0;
    }

    .link {
        text-align: center;
        margin-top: 10px;
    }

    .link a {
        color: #007bff;
        text-decoration: none;
    }

    .link a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1><i class="fas fa-sign-in-alt"></i> Login</h1>
        <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required autofocus>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p class="link">Don't have an account? <a href="register.php">Register here</a>.</p>
    </div>
</body>

</html>