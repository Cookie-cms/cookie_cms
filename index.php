<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

session_start();

$configFile = 'core/configs/config.inc.php';
if (!file_exists($configFile)) {
    header('Location: /setup/');
}else{

    require_once $_SERVER['DOCUMENT_ROOT'] . "/core/inc/template.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/core/configs/config.inc.php";
}

try {
    global $debugSetting, $developmentSetting, $generatorUsernameSetting;
    
    $debugSetting = $DEBUG['debug'];
    $developmentSetting = $DEBUG['development'];
    $generatorUsernameSetting = $DEBUG['generatorusername'];

    // Rest of your code using the settings
} catch (Exception $e) {
    echo 'Exception caught: ' . $e->getMessage();
}

$requestUri = $_SERVER['REQUEST_URI'];
$uriSegments = explode('/', trim($requestUri, '/'));
$page = isset($uriSegments[0]) && $uriSegments[0] !== '' ? $uriSegments[0] : 'index';

if (isset($_GET['code'])) {
    // Получение кода авторизации от Discord

    // Обработка авторизации и получение информации о пользователе (подставьте свои данные)
    $client_id = '1181148727826722816';
    $client_secret = 'S7Gbg79jiIgrgDhwprdiz7pBwen4aeVF';
    $redirect_uri = 'http://192.168.1.17/'; // Укажите ваш редирект URI

    // Запрос на обмен кода авторизации на токен доступа
    $code = $_GET['code'];
    $token_url = 'https://discord.com/api/oauth2/token';

    $data = array(
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'grant_type' => 'authorization_code',
        'code' => $code,
        'redirect_uri' => $redirect_uri,
    );

    $options = array(
        'http' => array(
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ),
    );

    $context = stream_context_create($options);
    $response = file_get_contents($token_url, false, $context);
    $token_data = json_decode($response, true);

    // Получение информации о пользователе из Discord API
    $access_token = $token_data['access_token'];

    // Получение информации о пользователе
    $user_url = 'https://discord.com/api/users/@me';

    $user_headers = array(
        'Authorization: Bearer ' . $access_token,
    );

    $user_context = stream_context_create(array(
        'http' => array(
            'header' => $user_headers,
        ),
    ));

    $user_response = file_get_contents($user_url, false, $user_context);
    $user_data = json_decode($user_response, true);

    // Передача информации в другой файл (например, process_user.php)
    $_SESSION['user_data'] = $user_data;
    header('Location: /core/auth/discord/login.php');
}

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

    if (file_exists($templatePath)) {
        include __TD__ . 'inc/header.php';
        include $templatePath;
    } elseif (file_exists($corePagePath)) {
        include $corePagePath;
    } else {
        echo '404 - Page Not Found';
    }
?>
