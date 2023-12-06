<?php

$host = "localhost";
$username = "admin";
$pass = "admin";
$db = "test";
$port = 3306;


// registetype 
// $registertype = "0"; can register all without discord
// $registertype = "1"; can register all with and without discord
// $registertype = "2"; can register only via discord all
// $registertype = "3"; can register only who in whitelist
// $registertype = "4"; disabled

$registertype = "1";
$minecraftsys = 1;
$capetype = "0";
$template = "bootstrap"; // name in dir templates

$modules = [];
$DEBUG = [
    'debug' => true,
    'development' => true,
    'generatorusername' => false
];

// 0 = only login
// 1 = add to guild
// 2 = add to guild and add to user role
$discordsys = 0;
$discordoauth = [
    'client_id' => "1181148727826722816",
    'secret_id' => "S7Gbg79jiIgrgDhwprdiz7pBwen4aeVF",
    'scopes' => 'identify',
    'redirect_url' => "http://192.168.1.17/",
    'bot' => "",
    'guild_id' => 0,
    'role' => 0
];

?>