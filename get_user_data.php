<?php 

// get_user_data.php
// Returns userdata in JSON-format

session_start(); 
header("Content-type: application/json; charset=utf-8");

// check if id-param is set
if (filter_has_var(INPUT_GET, 'id')){
    $id = $_GET['id'];
} else {
    $data = array(
        'status' => 'error',
        'message' => 'id not set'
    );
    
    echo json_encode($data);
    die();
}

require_once 'pdo_connect.php';

try {
    $stmt = $conn->prepare("SELECT id, firstname, lastname, email, banned, password_hint 
                            FROM users
                            WHERE id = :id;");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $row = $stmt->fetch();

    echo json_encode($row);

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
