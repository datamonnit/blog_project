<?php 
session_start(); 

include 'layout/header.php'; 

$firstname = isset($_SESSION['firstname']) ? $_SESSION['firstname'] : "";
$lastname = isset($_SESSION['larstname']) ? $_SESSION['lastname'] : "";
$email = isset($_SESSION['email']) ? $_SESSION['email'] : "";

if (isset($_GET['msg'])) {
    $msg = urldecode($_GET['msg']);
}
?>


    <h1 class="display-3">Register new user</h1>
    <?php if (isset($msg)): ?>
        <p><?php echo $msg; ?></p>
    <?php endif; ?>
    <form action="new_user.php" method="post">
        <div class="form-group">
            <label for="firstname">Firstname</label>
            <input class="form-control" type="text" name="firstname" id="name" value="<?php echo $firstname;?>">
        </div>
        <div class="form-group">
            <label for="lastname">Lastname</label>
            <input class="form-control" type="text" name="lastname" id="name" value="<?php echo $lastname;?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" value="<?php echo $email;?>">
        </div>
        <div class="form-group">
            <label for="passwd1">Password</label>
            <input class="form-control" type="password" name="passwd1" id="passwd1">
        </div>
        <div class="form-group">
            <label for="passwd2">Password verify</label>
            <input class="form-control" type="password" name="passwd2" id="passwd2">
        </div>
        
        <input class="btn btn-primary" type="submit" name="save_btn" value="Register">
    </form>

    <?php include 'layout/footer.php'; ?>