<?php
require_once 'pdo_connect.php';

$stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();

header('Location: show_users.php');