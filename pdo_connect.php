<?php
include_once('db_config.php');

try {
    $conn = new PDO("mysql:$HOST=;dbname=$DB;charset=utf8", $USER, $PASSWORD);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<script>console.log('Connected successfully')</script>";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }