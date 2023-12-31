<?php
// error_reporting(E_ALL);
// ini_set('display_errors', true);    
require "config.php";

try {
    $conn = new PDO("mysql:host=$hostsql;dbname=$db", $hostuser, $hostpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection died - " . $e->getMessage();
}

?>
