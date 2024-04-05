<?php

$host = "localhost";
$username = "admin";
$pass = "admin";
$db = "test";
$port = 3306;

$registertype = "0"; 
$minecraftsys = 1;
$capetype = "0";
$template = "bootstrap"; // name in dir templates


$modules = [];
$DEBUG = [
    'debug' => false,
    'development' => false,
    'generatorusername' => false
];

$discordsys = 0;
$discordoauth = [
    'client_id' => "1181148727826722816",
    'secret_id' => "0WEfIaRepS4lAhYhZt-NxPqswtRca1B0",
    'scopes' => 'identify',
    'redirect_url' => "http://192.168.1.26/",
    'bot' => "",
    'guild_id' => 0,
    'role' => 0
];
?>