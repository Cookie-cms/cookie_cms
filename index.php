<?php
// error_reporting(E_ALL);
// ini_set('display_errors', true);

$configFile = 'core/configs/config.inc.php';
if (!file_exists($configFile)) {
    header('Location: /setup/');
}else{

    require_once $_SERVER['DOCUMENT_ROOT'] . "/core/inc/template.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/core/configs/config.inc.php";
}

try {
    $debugSetting = $DEBUG['debug'];
    $developmentSetting = $DEBUG['devlopment'];
    $generatorUsernameSetting = $DEBUG['generatorusername'];

    // Rest of your code using the settings
} catch (Exception $e) {
    echo 'Exception caught: ' . $e->getMessage();
}

$requestUri = $_SERVER['REQUEST_URI'];
$uriSegments = explode('/', trim($requestUri, '/'));
$page = isset($uriSegments[0]) && $uriSegments[0] !== '' ? $uriSegments[0] : 'index';


$templatePath = __DIR__ . "/templates/{$template}/pages/{$page}.php";
$corePagePath = __DIR__ . "/core/{$page}/main.php";

if (in_array('logout', $uriSegments)) {
    $corePagePath = $_SERVER['DOCUMENT_ROOT'] . '/core/auth/logout.php';
} else {
    $corePagePath = __DIR__ . "/core/{$page}/main.php";
}
if ($debugSetting) {
    echo "Template: {$template}<br>"; // Debug: Check the current template
    echo "Template Path: {$templatePath}<br>"; // Debug: Check the path to the page
    echo "Core Page Path: {$corePagePath}<br>"; // Debug: Check the path to the core page
    echo "Requested URI: {$requestUri}<br>"; // Debug: Output the requested URI
}


define('__RD__', '/');
define('__RDS__', $_SERVER['DOCUMENT_ROOT']);
define('__UD__', __RD__ . 'uploads/');
define('__TD__', __RDS__ . "/templates/{$template}/");
define('__TDS__', __RD__ . "templates/{$template}/");
define('__CD__', __RDS__ . '/core/');
define('__CF__', __CD__ . 'configs/');
define('__CI__', __CD__ . 'inc/');
define('__CSS__', __TD__ . 'css/');
define('__JS__', __TD__ . 'js/');
define('__AS__', __TD__ . 'assets/');
define('__INT__', __TD__ . 'inc/');

if (!file_exists($configFile)) {
    if (file_exists($templatePath)) {
        include __TD__ . 'inc/header.php';
        include $templatePath;
    } elseif (file_exists($corePagePath)) {
        include $corePagePath;
    } else {
        echo '404 - Page Not Found';
    }
}
?>
