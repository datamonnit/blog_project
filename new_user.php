<?php
session_start();

// Check if user comes from register form
if (!isset($_POST['save_btn']) && $_POST['save_btn'] != 'Register') {
        $msg = "Did not come from correct form!";
        $_SESSION['error'] = $msg;
        header("Location: error.php");
        die();
    }

// Get data
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$passwd1 = $_POST['passwd1'];
$passwd2 = $_POST['passwd2'];
$password_hint = $_POST['password_hint'];

// Create sessiondata
$_SESSION = $_POST;

if ($passwd1 != $passwd2) {
    $url = parse_url($_SERVER['HTTP_REFERER']);
    $msg = "Passwords don't match";
    $myurl = $url['scheme'] . "://" . $url['host'] . $url['path'];
    header("Location: $myurl?msg=$msg");
    die();
}

// Create passwd-hash
$passwd_hash = password_hash($_POST['passwd1'], PASSWORD_DEFAULT);

require_once 'pdo_connect.php';

try {
    // Prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, passwd, password_hint)
                            VALUES (:firstname, :lastname, :email, :passwd, :password_hint)");
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':passwd', $passwd_hash);
    $stmt->bindParam(':password_hint', $password_hint);
   
    $stmt->execute();

    echo "New user created successfully";    
    
}
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;




// if (password_verify($password1 . '2', $pwd_hash)) {
//     echo 'Password is correct!';
// } else {
//     echo 'Password is incorrect!';
// }