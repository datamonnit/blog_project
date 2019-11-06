<?php
if (!isset($_GET['msg'])) {
    $msg = 'General error! Sorry!';
} else {
    $msg = urldecode($_GET['msg']);
}
?>
<h1>Error</h1>
<p><?php echo $msg; ?></p>