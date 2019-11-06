<?php 
session_start(); 
$firstname = isset($_SESSION['firstname']) ? $_SESSION['firstname'] : "";
$lastname = isset($_SESSION['larstname']) ? $_SESSION['lastname'] : "";
$email = isset($_SESSION['email']) ? $_SESSION['email'] : "";

if (isset($_GET['msg'])) {
    $msg = urldecode($_GET['msg']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    
    <h1>Register new user</h1>
    <?php if (isset($msg)): ?>
        <p><?php echo $msg; ?></p>
    <?php endif; ?>
    <form action="new_user.php" method="post">
        <label for="firstname">Firstname</label>
        <input type="text" name="firstname" id="name" value="<?php echo $firstname;?>">
        <label for="lastname">Lastname</label>
        <input type="text" name="lastname" id="name" value="<?php echo $lastname;?>">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php echo $email;?>">
        <label for="passwd1">Password</label>
        <input type="password" name="passwd1" id="passwd1">
        <label for="passwd2">Password verify</label>
        <input type="password" name="passwd2" id="passwd2">
        <input type="submit" name="save_btn" value="Register">
    </form>

</body>
</html>