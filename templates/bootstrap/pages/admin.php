<?php
// error_reporting(E_ALL);
// ini_set('display_errors', true);
require __CF__ . 'staticinfo.php';
echo "__TD__ Path: " . __TD__ . "<br>";

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    
    <!-- Include CSS -->
    <!-- <link rel="stylesheet" href="<?php echo __CSS__ . 'admin.css'; ?>"> -->

    <!-- Include JS -->
    <script src="<?php echo __JS__ . 'home.js'; ?>"></script>
</head>
<!-- <style> 
/* body{ */
/* font-family: 'Vina Sans', sans-serif;} */
 /* </style>  -->
<body>
    <!-- Content of the home page -->

    <!-- Example of using an asset (image) -->
    <img src="<?php echo __AS__ . 'default.png'; ?>" alt="Example Image">

    <!-- Additional HTML content -->
    <h1>Welcome to the Home Page</h1>
    <p>This is the content of the home page.</p>
</body>
</html>
