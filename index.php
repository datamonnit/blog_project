<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['errors'][] = 'Login first to use system!';
    header('Location: login.php');
}

?>
<?php include 'layout/header.php'; ?>

<h1 class="display-3">DaBlog</h1>

<?php include 'layout/footer.php'; ?>
