<?php

// show_topics.php

session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = 'Not allowed!';
    header('Location: login.php');
}

include 'layout/header.php'; 

require_once 'pdo_connect.php';

try {
    $stmt = $conn->prepare("SELECT id, name, description FROM categories");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $stmt->fetchAll(); ?>

    <div class="row">
        <h1 class="display-3">Topics</h1>
    </div>
    <div class="row">
        <?php foreach ($rows as $row): ?>
            <div class="col-sm">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name']; ?></h5>
                        <p class="card-text"><?php echo $row['description']; ?></p>
                        <a href="show_posts.php?topic_id=<?php echo $row['id']; ?>" class="card-link">Show posts</a>
                    </div>
                </div>    
            </div>

        <?php endforeach; ?>
    </div><?php
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;


include 'layout/footer.php'; ?>