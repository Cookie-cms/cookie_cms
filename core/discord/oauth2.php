<?php 
error_reporting(E_ALL);
ini_set('display_errors', true);
require_once $_SERVER['DOCUMENT_ROOT'] . "/define.php";
$config = require_once __CF__ . "config.inc.php";



$clientId = $discordoauth['client_id'];
$redirectUri = $discordoauth['redirect_url'];
$scope = $discordoauth['scopes'];
function gen_state() {
    return bin2hex(random_bytes(16));
}


$state = gen_state();

$authorizeUri = 'https://discordapp.com/oauth2/authorize?response_type=code&client_id=' . $clientId . '&redirect_uri=' . $redirectUri . '&scope=' . $scope . '&state=' . $state;

header("Location: $authorizeUri");
exit();
?>
