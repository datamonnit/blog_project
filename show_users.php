<?php
session_start();
// if (!isset($_SESSION['user_id'])) {
//     $_SESSION['error'] = 'Not allowed!';
//     header('Location: login.php');
// }
?>
<?php include 'layout/header.php'; ?>

<?php

require_once 'db_config/pdo_connect.php';

try {
    $stmt = $conn->prepare("SELECT id, firstname, lastname, email, banned, password_hint FROM users");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $stmt->fetchAll();
?>

<h1 class="display-3">All users</h1>

<table class="table">
    <tr>
        <th>lastname</th>
        <th>firstname</th>
        <th>email</th>
        <th>password hint</th>
        <th>actions</th>
    </tr>

<?php foreach ($rows as $row): ?>
    <tr>
        <td>
            <?php echo $row['lastname']; ?>
        </td>
        <td>
            <?php echo $row['firstname']; ?>
        </td>
        <td>
            <?php echo $row['email']; ?>
        </td>
        <td>
            <?php echo $row['password_hint']; ?>
        </td>
        <td>
            <?php 
            if ($row['banned'] == 0) {
                echo '<a class="btn btn-warning" href="app/ban.php?id='.$row['id'].'">ban</a>';
            }  else {
                echo '<a class="btn btn-primary" href="app/ban.php?id='.$row['id'].'">unban</a>';
            }
            ?>
            <a class="btn btn-danger" href="app/delete_user.php?id=<?php echo $row['id']; ?>">delete</a>

            <a class="btn btn-info" href="edit_user.php?id=<?php echo $row['id']; ?>">edit</a>

        </td>
    </tr>
<?php endforeach; ?>

</table>

<?php
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;


include 'layout/footer.php'; ?>