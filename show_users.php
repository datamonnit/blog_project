<?php include 'layout/header.php'; ?>

<?php

require_once 'pdo_connect.php';

try {
    $stmt = $conn->prepare("SELECT id, firstname, lastname, email, banned FROM users");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $stmt->fetchAll();
?>

<h1>All users</h1>

<table class="table">
    <tr>
        <th>lastname</th>
        <th>firstname</th>
        <th>email</th>
        <th>banned</th>
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
            <?php 
            if ($row['banned'] == 0) {
                echo '<a class="btn btn-danger" href="ban.php?id='.$row['id'].'">ban</a>';
            }  else {
                echo '<a class="btn btn-primary" href="ban.php?id='.$row['id'].'">unban</a>';
            }
            ?>
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