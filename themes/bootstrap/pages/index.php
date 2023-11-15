<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

// echo __DIR__; // print current directory

// $corePath = __DIR__ . '/../core'; 

// echo $corePath; // print full path to core directory

// require $corePath . '/configs/information.inc.php';

// require $corePath . '/login/login.php'; 

// echo realpath('../../core/configs/information.inc.php'); // get full path

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register/Login Forms</title>
  <!-- Add Bootstrap CSS link -->
  <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="<?= __TD__ ?>css/login_register.css">
</head>
<body>
<div class="form-structor">
	<div class="signup">
		<h2 class="form-title" id="signup"><span>or</span>Sign up</h2>
		<div class="form-holder">
		<form action="<?= __CORE__ ?>register/register.php" method="post">
			<input type="text" class="input" name="uname" placeholder="Name" />
			<input type="password" class="input" name="password" placeholder="Password" />
			<input type="password" class="input" name="re_password" placeholder="Reapt Password" />
		</div>
		<button class="submit-btn">Sign up</button>
		</form>
	</div>
	<div class="login slide-up">
		<div class="center">
			<h2 class="form-title" id="login"><span>or</span>Log in</h2>
			<div class="form-holder">
			<form action="<?= __CORE__ ?>login/login.php" method="post">
				<input type="text" class="input" name="uname" placeholder="Username" />
				<input type="password" class="input" name="password" placeholder="Password" />
			
			</div>
			<button class="submit-btn">Log in</button>
			</form>
		</div>
	</div>
</div>
<script src="<?= __TD__ ?>js/login_register.js"></script>

</body>
</html>