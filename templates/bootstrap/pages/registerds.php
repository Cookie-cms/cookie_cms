<?php

error_reporting(E_ALL);  
ini_set('display_errors', true);
// include 'inc/header.php';
// session_start();
// require("core/configs/config.inc.php")
// require_once("core");
global $generatorUsernameSetting; // Access the variable from the global scope
require __CF__ . 'staticinfo.php';
require_once __CD__ . 'register/info.php';
$avatarUrl = getUserAvatarUrl();
// echo 'User Avatar URL: ' . $avatarUrl;
// Use $generatorUsernameSetting in your template
if (!isset($_SESSION['user_data'])) {
    // Если данных нет, перенаправляем пользователя на страницу авторизации Discord
    header('Location: https://discord.com/api/oauth2/authorize?client_id=1181148727826722816&response_type=code&redirect_uri=http%3A%2F%2F192.168.1.17%2F&scope=identify');
    exit(); // Обязательно завершаем выполнение скрипта после перенаправления
}
$usernameds = getusernameds();


?>

    <!DOCTYPE html>
    <html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
         <!-- <link href="css/home.css"> -->
         <title><?php echo $titlepage ?> &#x2022 Index</title>
         <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"> -->
         <!-- <link rel="stylesheet" href="css/home.css"> -->
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    </head>
    <body>
    <!-- <div id="navbarContainer"></div> -->
    <!-- <link rel="stylesheet" href="css/main.css"> -->
    <link rel="stylesheet" href="<?php echo __TDS__; ?>css/main.css">


<div class="container ">
    <!-- <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="toggleButton" checked>
        <label class="form-check-label" for="toggleButton">Toggle Dark Mode</label>
</div> -->
</div>  
<!-- <div class="col-md-4 border-right"> -->
                <!-- </div>  -->
    <cat class="rounded position-absolute top-50 start-50 translate-middle">
        
        <div class="col-md-5">
        <img class="position-absolute rounded-circle start-50 translate-middle" src="<?=$avatarUrl?>" height="94" />
            <h3>Register</h3>
                <form method="post" action="<?php echo __RD__; ?>core/auth/discord/register.php">
                    <div class="form-group">
                        <label for="registerUsername">Username:</label>
                        <input type="text" class="form-control mt-3 " style="width: 450px;" id="registerUsername" name="username" value="<?=$usernameds?>" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="registerPassword">Password:</label>
                        <input type="password" class="form-control mt-3" style="width: 450px" id="registerPassword" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="registerrePassword">Re-enter Password:</label>
                        <input type="password" class="form-control mt-3" style="width: 450px;" id="registerrePassword" name="re_password" placeholder="Password">
                    </div>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox"  value="" id="flexCheckDefault" required>
                        <label class="form-check-label" for="flexCheckDefault">
                            Accept terms
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Register</button>
                </form>
            </div>
            <div class="container">
            <div class="position-absolute top-0 end-0">
                <div style="background-color: white;" width="280px" height="420"></div>
            </div>
            </div>
        

    </cat>
    <script>
    // Accessing the PHP variable value in JavaScript
    var generatorUsernameSetting = <?php echo json_encode($generatorUsernameSetting); ?>;
    
    // Check if generatorUsernameSetting is true before generating usernames
    window.onload = function() {
        if (generatorUsernameSetting) {
            const usernameInput = document.getElementById('registerUsername');
            const passwordInput = document.getElementById('registerPassword');
            const rePasswordInput = document.getElementById('registerrePassword');
            
            if (usernameInput && passwordInput) {
                const generatedUsername = generateRandomString(8);
                
                usernameInput.value = generatedUsername;
                passwordInput.value = generatedUsername; // Using the same name as the password
                rePasswordInput.value = generatedUsername;
            }
        }
    };

    function generateRandomString(length) {
        const characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let randomString = '';
        for (let i = 0; i < length; i++) {
            randomString += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return randomString;
    }
</script>

</div>

    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <div class="background-image"></div> -->
    </script>
      <!-- <script src="script.js"></script> -->
    <script src="js/darktheme.js"></script>
    
    </html>