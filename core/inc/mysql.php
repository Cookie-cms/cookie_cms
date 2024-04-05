<?php
error_reporting(E_ALL);
ini_set('display_errors', true);    
// require $_SERVER['DOCUMENT_ROOT']."/core/configs/config.inc.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/define.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use Symfony\Component\Yaml\Yaml;

$data = Yaml::parseFile($_SERVER['DOCUMENT_ROOT'] . '/core/configs/config.inc.yaml');

$host = $data['DATABASE']['host'];
$db = $data['DATABASE']['db'];
$username = $data['DATABASE']['username'];
$password = $data['DATABASE']['pass'];
// $port = $data['port'];

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection died - " . $e->getMessage();
}

?>
