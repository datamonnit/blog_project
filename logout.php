<?php
// Destroy user session
session_start();
unset($_SESSION['user_id']);
header('Location: login.php');