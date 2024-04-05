<?php
error_reporting(E_ALL);  
ini_set('display_errors', true);
$requestUri = $_SERVER['REQUEST_URI'];
$uriSegments = explode('/', trim($requestUri, '/'));
$page = isset($uriSegments[0]) && $uriSegments[0] !== '' ? $uriSegments[0] : 'index';
define('__URI__', strstr($_SERVER['REQUEST_URI'], '?', true) ? strstr($_SERVER['REQUEST_URI'], '?', true) : $_SERVER['REQUEST_URI']);
define('__URL__', array_slice(explode('/', substr(__URI__, 1)), 0, 3));

if (__URL__[1] == "oauth2") {
    $uriParameters = http_build_query($_GET);

    $moduleFilePath = __CD__ . "core/api/oauth2.php";
    if (file_exists($moduleFilePath)) {
        include $moduleFilePath;
    }
} 
if (__URL__[1] == "discord") {
    $uriParameters = http_build_query($_GET);

    $moduleFilePath = __CD__ . "core/api/discord.php";
    if (file_exists($moduleFilePath)) {
        include $moduleFilePath;
    } 
} 

if (__URL__[1] == "admin") {
    $uriParameters = http_build_query($_GET);

    $moduleFilePath = __CD__ . "core/api/admin.php";
    if (file_exists($moduleFilePath)) {
        include $moduleFilePath;
    }
} 

if (__URL__[1] == "") {
        http_response_code(404);
        die("404 - Page Not Found");
} 