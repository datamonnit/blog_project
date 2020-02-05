<?php 
/* 
forgot_password.php
This script will controll resetting password:
1) Show Send reset link -form
2) Process Send reset link -form
3) Show Reset password -form
4) Process Reset password -form
 */
session_start();

// Process Send reset link -form
if (isset($_POST['btn_send_reset_link'])) {
    
    include_once 'config.php';

    include 'pdo_connect.php';
    
    // Check if email is found in db  
    $email = $_POST['email'];

    $stmt = $conn->prepare("SELECT id, email, passwd FROM users WHERE email=:email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $stmt->fetchAll();
    
    if (count($rows)) {
        // Create and insert unique id/hash to verify password cahnge
        $unique_id = uniqid();

        $stmt = $conn->prepare("UPDATE users
        SET hash = :unique_id, hash_expire = NOW() + INTERVAL 1 DAY
        WHERE email = :email");
        $stmt->bindParam(':unique_id', $unique_id);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Send email with link to Reset password -form
        $subject = 'Password reset request';
        $link = "{$_SERVER['HTTP_REFERER']}?hash=$unique_id";

        $headers = "From: " . ADMIN_EMAIL . "\r\n";
        $headers .= "Reply-To: noreply@example.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        $message = '<html><body><h1>Reset password</h1><p>Click the link to reset password</p><p><a href="'.$link.'">'.$link.'</a></body></html>';

        // Send email with link to Reset password -form
        if (mail($email, $subject, $message, $headers)){
            $msg = "Check your mail for reset link!";
        } else {
            $msg = "Error occured!";
        }


    }
}

if (isset($_POST['btn_reset_password'])){
    
}


?>

<?php include 'layout/header.php' ?>
<div class="row d-block">

    <h1 class="display-3 d-block">Forgot password</h1>
    
    <?php if (isset($msg)):?>
        <div class="alert alert-primary">
            <?php echo $msg; ?>
        </div>
    <?php endif; ?>
    

    <?php if (!isset($_GET['hash'])): ?>


        <form class="form-inline" action="forgot_password.php" method="POST">
            <label for="email" class="mr-sm-2">Email address:</label>
            <input name="email" type="email" class="form-control mb-2 mr-sm-2" id="email">
            <button type="submit" name="btn_send_reset_link" class="btn btn-primary mb-2">Send reset link</button>
        </form>

    <?php else: ?>
        <form class="form-inline" action="forgot_password.php" method="POST">
            <label for="password1" class="mr-sm-2">New password:</label>
            <input name="password1" type="password" class="form-control mb-2 mr-sm-2" id="password1">

            <label for="password2" class="mr-sm-2">Confirm password:</label>
            <input name="password2" type="password" class="form-control mb-2 mr-sm-2" id="password2">

            <button type="submit" name="btn_reset_password" class="btn btn-primary mb-2">Reset password</button>
        </form>
    <?php endif; ?>

</div>


<?php include 'layout/footer.php' ?>