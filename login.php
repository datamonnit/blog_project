<?php 

/* 
login.php
This script will show login form and process login
 */

session_start();

// Process login -form
if ( filter_has_var(INPUT_POST, 'btn_login') ) {

    $errors = [];

    // Check if email and password are not empty
    if (empty($_POST['email'])) {
        $errors[] = "Email is required!";
    }

    if (empty($_POST['passwd'])) {
        $errors[] = "Password cannot be empty!";
    }

    if (!empty($errors)){
        $_SESSION['errors'] = $errors;
        header('Location: login.php?');
        die();

    }

    include 'pdo_connect.php';
    
    $email = $_POST['email'];

    $stmt = $conn->prepare("SELECT id, email, passwd FROM users WHERE email=:email");
    $stmt->bindParam(':email', $email);
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
            $errors[] = 'Invalid password!';
        }
    } else {
        $errors[] = 'Login failed';
    }

    if (!empty($errors)){
        $_SESSION['errors'] = $errors;
        header('Location: login.php');
        die();

    }
}
?>

<?php include 'layout/header.php' ?>
<div class="row d-block">

    <h1 class="display-3 d-block">Login</h1>
    <?php

    // Show possible errors
    if (isset($_SESSION['errors'])):
        foreach ($_SESSION['errors'] as $error): ?>
           <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endforeach;
    endif; 
    
    unset($_SESSION['errors']);

    // Show possible info
    if (isset($_SESSION['info'])):
        foreach ($_SESSION['info'] as $info): ?>
        <div class="alert alert-info"><?php echo $info; ?></div>
        <?php endforeach;
    endif; 

    unset($_SESSION['info']);

    ?>

    <form class="form-inline" action="login.php" method="POST">
        <label for="email" class="mr-sm-2">Email address:</label>
        <input name="email" type="email" class="form-control mb-2 mr-sm-2" id="email">
        <label for="pwd" class="mr-sm-2">Password:</label>
        <input name="passwd" type="password" class="form-control mb-2 mr-sm-2" id="pwd">
        <button type="submit" name="btn_login" class="btn btn-primary mb-2">Login</button>
    </form>

    <a href="forgot_password.php">Forgot password</a>

</div>


<?php include 'layout/footer.php' ?>