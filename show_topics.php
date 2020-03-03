<?php

// show_topics.php
session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = 'Not allowed!';
    header('Location: login.php');
}

include 'layout/header.php'; 

require_once 'db_config/pdo_connect.php';

try {
    $stmt = $conn->prepare("SELECT id, name, description, likes FROM categories");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $stmt->fetchAll(); ?>

    <div class="row">
        <h1 class="display-3">Topics</h1>
    </div>
    <div class="row">
        <?php foreach ($rows as $row): ?>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $row['name']; ?> 
                            Likes
                                <span id="like-<?php echo $row['id']; ?>">
                                    <?php echo $row['likes']; ?>
                                </span>
                                <span class="cursor-pointer" 
                                  onclick="like('categories', <?php echo $row['id']; ?>)">
                                    &#128077;
                                </span>
                        </h5>
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

?>
    <div class="row">
        <div class="col">
            <h2>Add new topic</h2>
            <form action="add_topic.php" method="post">
                <div class="form-group">
                    <label for="topic_name">Topic name </label>
                    <input class="form-control" type="text" name="topic_name" id="topic_name">
                </div>
                <div class="form-group">
                    <label for="topic_description">Topic description </label>
                    <input class="form-control" type="text" name="topic_description" id="topic_description">
                </div>
                <input class="btn btn-primary" type="submit" name="save_btn" value="Add">
            </form>
        </div>
    </div>

<script>
// This function calls php-skript to update database
function like(target, id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            let data = JSON.parse(this.responseText);
            if(data.status == 'OK') {
                document.getElementById('like-'+data.id).innerHTML++;
            }
            
        }
    };
    xmlhttp.open("GET", "app/like.php?target=" + target + "&id=" + id, true);
    xmlhttp.send();
}
</script>
<?php
include 'layout/footer.php'; ?>