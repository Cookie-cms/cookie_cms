<?php 
error_reporting(E_ALL);
ini_set('display_errors', true);
session_start(); 
require $_SERVER['DOCUMENT_ROOT']."/core/inc/mysql.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['uuid'] = $user['uuid'];
        // echo "Session created!";
        
        $home = "/home.php";
        header("Location: $home");
        exit();
    } else {
        header("Location: index.php?error=Incorrect User name or password");
        exit();
    }
}

?>
