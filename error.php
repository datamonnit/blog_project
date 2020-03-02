<?php
session_start();

// Show possible errors
if (isset($_SESSION['errors'])):
    foreach ($_SESSION['errors'] as $error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endforeach;
endif; 

unset($_SESSION['errors']);

?>
<h1>Error</h1>
<p><?php echo $msg; ?></p>