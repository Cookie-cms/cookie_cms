<?php

// error_reporting(E_ALL);  
// ini_set('display_errors', true);
// include 'inc/header.php';

// require("core/configs/config.inc.php")
// require_once("core");
global $generatorUsernameSetting; // Access the variable from the global scope

// Use $generatorUsernameSetting in your template

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
    <div class="container rounded mt-5 position-absolute top-50 start-50 translate-middle">
    <div class="row">
        <div class="col-md-6">
            <h3>Login</h3>
            <form method="post" action="<?php echo __RD__; ?>core/auth/login.php">
                <div class="form-group">
                    <label for="loginUsername">Username:</label>
                    <input type="text" class="form-control mt-3" id="loginUsername" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label for="loginPassword">Password:</label>
                    <input type="password" class="form-control mt-3" id="loginPassword" name="password" placeholder="Password" required>
                </div>
                <div class="form-check mt-3">
                    <input class="form-check-input " type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Remember me
                    </label>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Login</button>
            </form>
        </div>
        <div class="col-md-6">
            <h3>Register</h3>
                <form method="post" action="<?php echo __RD__; ?>core/auth/register.php">
                    <div class="form-group">
                        <label for="registerUsername">Username:</label>
                        <input type="text" class="form-control mt-3" id="registerUsername" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="registerPassword">Password:</label>
                        <input type="password" class="form-control mt-3" id="registerPassword" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="registerrePassword">Re-enter Password:</label>
                        <input type="password" class="form-control mt-3" id="registerrePassword" name="re_password" placeholder="Password">
                    </div>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                        <label class="form-check-label" for="flexCheckDefault">
                            Accept terms
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Register</button>
                </form>
            </div>

    </div>
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