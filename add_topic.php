<?php
session_start();

// Check if user comes from register form
if (!isset($_POST['save_btn']) && $_POST['save_btn'] != 'Register') {
    $msg = "Did not come from correct form!";
    $_SESSION['error'] = $msg;
    header("Location: error.php");
    die();
}

// Get data 
$topic_name = trim($_POST['topic_name']);
$topic_description = trim($_POST['topic_description']);

require_once 'db_config/pdo_connect.php';

try {
    // Prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO categories (name, description)
                            VALUES (:name, :description)");
    $stmt->bindParam(':name', $topic_name);
    $stmt->bindParam(':description', $topic_description);
       
    $stmt->execute();

    echo "New topic created successfully";    
    
    header('Location: show_topics.php');
}
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;

