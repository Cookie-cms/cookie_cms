<?php
// error_reporting(E_ALL);
// ini_set('display_errors', true);    
require $_SERVER['DOCUMENT_ROOT']."/core/configs/config.inc.php";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $username, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection died - " . $e->getMessage();
}

?>
