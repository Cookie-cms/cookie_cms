<?php
// index.php
include 'core/themes.php';

// define('__CORE__', __DIR__ . '/core/');

// define('__RD__', dirname(__FILE__).'/');

// define('__TD__', __RD__ . 'themes/' . $theme . '/');

// define('__IMG__', __RD__ . 'img');
// define('__RD__', dirname(__FILE__).'/');
define('__RD__', '/');
define('__UD__', __RD__.'uploads/');
// define('__TD__', __RD__.'template/');
define('__TD__', __RD__ . 'themes/' . $theme . '/');

// define('__ED__', __RD__.'engine/');
define('__CORE__', __RD__.'core/');

// define('__IMG__', __DIR__ . '/img/');

// Include the themes file

// Determine the requested page from the URL
$requestPage = trim($_SERVER['REQUEST_URI'], '/');
$requestPage = $requestPage ? $requestPage : 'index'; // Set the default page to 'index'

// Include the theme-specific files
includeThemeFiles($theme);

// Determine the actual page to render
renderThemePage($theme, $requestPage);

// Rest of your code
?>
