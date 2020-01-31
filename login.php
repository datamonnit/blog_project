<?php 
session_start();
if (isset($_POST['btn_login'])) {

    include 'pdo_connect.php';
    
    $stmt = $conn->prepare("SELECT id, email, passwd FROM users");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $stmt->fetchAll();

    if (count($rows)) {
        $passwd = $rows[0]['passwd'];
        if ( password_verify( $_POST['passwd'] , $passwd ) ) {
            echo "<script>console.log('You are in!')</script>";
            $_SESSION['user_id'] = $rows[0]['id'];
            header('Location: index.php');
            die();
        } else {
            echo "<script>console.log('Login failed!')</script>";
            $_SESSION['error'] = 'Login failed!';
            header('Location: login.php');
            die();
        }
    }

}
?>

<?php include 'layout/header.php' ?>
<div class="row d-block">

    <h1 class="display-3 d-block">Login</h1>

    <form class="form-inline" action="login.php" method="POST">
    <label for="email" class="mr-sm-2">Email address:</label>
    <input name="email" type="email" class="form-control mb-2 mr-sm-2" id="email">
    <label for="pwd" class="mr-sm-2">Password:</label>
    <input name="passwd" type="password" class="form-control mb-2 mr-sm-2" id="pwd">
    <button type="submit" name="btn_login" class="btn btn-primary mb-2">Login</button>
    </form>
</div>


<?php include 'layout/footer.php' ?>