<?php
session_start();

// Check if user comes from register form
if (!isset($_GET['target']) && isset($_GET['id'])) {
    $msg = "Did not come from correct form!";
    $_SESSION['error'] = $msg;
    header("Location: error.php");
    die();
}

$table = $_GET['target'];
$id = $_GET['id'];

require_once '../db_config/pdo_connect.php';

try {
    // Prepare sql and bind parameters
    $stmt = $conn->prepare("UPDATE ".$table." SET likes = likes + 1 WHERE id = :id");
    $stmt->bindParam(':id', $id);
    
    $stmt->execute();

    $data = array(
        'status' => 'OK',
        'message' => 'Like updated',
        'id' => $id
    );
        
    
}
catch(PDOException $e)
    {
        $data = array(
            'status' => 'ERROR',
            'message' =>  "Error: " . $e->getMessage(),
        );
    
    }

echo json_encode($data);
$conn = null;