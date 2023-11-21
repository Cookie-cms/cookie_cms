<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
require_once $_SERVER['DOCUMENT_ROOT']."/core/inc/mysql.php";

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['re_password'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $pass = validate($_POST['password']);
    $re_pass = validate($_POST['re_password']);

    if ($pass !== $re_pass) {
        echo "Passwords do not match.";
        exit();
    }

    $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(random_bytes(16)), 4)); // Generate a random UUID

    $hashed_password = password_hash($pass, PASSWORD_BCRYPT);

    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=:username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "The username is taken, please choose another.";
            exit();
        } else {
            $stmt = $conn->prepare("INSERT INTO users (uuid, username, password) VALUES (:uuid, :username, :pass)");
            $stmt->bindParam(':uuid', $uuid);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':pass', $hashed_password);
            $stmt->execute();

            echo "User created successfully!";
            exit();
        }
    } catch (PDOException $e) {
        echo "An error occurred during registration. Please try again later.";
        error_log("PDOException: " . $e->getMessage(), 0);
        exit();
    }
} else {
    echo "Form data incomplete.";
    exit();
}
?>
