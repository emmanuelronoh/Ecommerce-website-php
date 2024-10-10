<?php
require 'db.php';
require 'functions.php';

$user_id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$user_id]);
redirect('dashboard.php');