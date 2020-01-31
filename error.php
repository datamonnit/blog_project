<?php
session_start();

if(isset($_SESSION['error'])) {
    $msg = $_SESSION['error'];
} else if (isset($_GET['msg'])) {
    $msg = urldecode($_GET['msg']);
} else {
    $msg = 'General error! Sorry!';
}

?>
<h1>Error</h1>
<p><?php echo $msg; ?></p>