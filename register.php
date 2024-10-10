<?php
require 'db.php';
require 'functions.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = escape($_POST['username']);
    $password = $_POST['password'];
    $role = escape($_POST['role']); // Get the selected role

    // Check if username already exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->rowCount() > 0) {
        $error = "Username already exists. Please choose a different one.";
    } else {
        // Hash the password and insert the new user
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->execute([$username, $hashedPassword, $role]); // Save role
        $success = "Registration successful! You can now log in.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 300px;
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

    input[type="text"],
    input[type="password"],
    select {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #5cb85c;
        border: none;
        border-radius: 5px;
        color: white;
        font-size: 16px;
    }

    button:hover {
        background-color: #4cae4c;
    }

    .message {
        text-align: center;
        color: red;
    }

    .success {
        color: green;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Register</h1>
        <?php if ($error): ?>
        <p class="message"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
        <p class="success"><?php echo $success; ?></p>
        <?php endif; ?>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit">Register</button>
        </form>
        <p style="text-align: center;">Already have an account? <a href="login.php">Login here</a>.</p>
    </div>
</body>

</html>