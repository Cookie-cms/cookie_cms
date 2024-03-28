<?php
// error_reporting(E_ALL);
// ini_set('display_errors', true);
require_once $_SERVER['DOCUMENT_ROOT'] . "/define.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
session_start();
use Symfony\Component\Yaml\Yaml;

$data = Yaml::parseFile($_SERVER['DOCUMENT_ROOT'] . '/core/configs/config.inc.yaml');


$debugSetting = $data['DEBUG']['debuging'];
$generatorUsernameSetting = $data['DEBUG']['generatorusername'];
$registrationSetting = $data['registration'];
$configFile = 'core/configs/config.inc.yaml';


$requestUri = $_SERVER['REQUEST_URI'];
$uriSegments = explode('/', trim($requestUri, '/'));
$page = isset($uriSegments[0]) && $uriSegments[0] !== '' ? $uriSegments[0] : 'index';
define('__URI__', strstr($_SERVER['REQUEST_URI'], '?', true) ? strstr($_SERVER['REQUEST_URI'], '?', true) : $_SERVER['REQUEST_URI']);
define('__URL__', array_slice(explode('/', substr(__URI__, 1)), 0, 3));



$templatePath = __DIR__ . "/template/pages/{$page}.php";
$corePagePath = __DIR__ . "/core/{$page}/main.php";


if ($debugSetting) {
    echo "Core Page Path: {$corePagePath}<br>"; // Debug: Check the path to the core page
    echo "Requested URI: {$requestUri}<br>"; // Debug: Output the requested URI
}


if (file_exists($templatePath)) {
    include __TD__ . 'inc/header.php';
    include $templatePath;
} elseif (file_exists($corePagePath)) {
    include $corePagePath;
} else {
    echo '404 - Page Not Found';
}
?>