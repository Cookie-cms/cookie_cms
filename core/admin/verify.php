<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/core/inc/mysql.php";

try {
    $sessionUUID = $_SESSION['uuid'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE uuid = :uuid");
    $stmt->bindParam(':uuid', $sessionUUID);
    $stmt->execute();
    $fetchedUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($fetchedUser && $fetchedUser['perm'] < 3) {
        // Redirect the user to the home page or any other appropriate page
        header("Location: /"); // Change this URL to your home page URL
        exit(); // Ensure the script stops executing after the redirect
    }

    // Continue with the rest of your code for users with permission level 3 or higher

    // ...
} catch (PDOException $e) {
    // Handle any potential database errors here
    // Log or display an error message
}
