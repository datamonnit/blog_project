<?php
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

require_once '../db_config/pdo_connect.php';

try {
    $stmt = $conn->prepare("SELECT posts.id, topic, body, created, users_id, categories_id 
                            FROM posts
                            INNER JOIN users ON posts.users_id = users.id
                            WHERE posts.categories_id = :id;");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $stmt->fetchAll();

    if (count($rows) == 0){
        $data = array(
            'status' => 'error',
            'message' => 'no posts available'
        );
        echo json_encode($data);
    } else {
        echo json_encode($rows);
    }

    

} catch(PDOException $e) {
    $data = array(
        'status' => 'error',
        'message' => 'id not set'
    );
    echo json_encode($data);

}
$conn = null;