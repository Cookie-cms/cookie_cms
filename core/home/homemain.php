<?php
// error_reporting(E_ALL);  
// ini_set('display_errors', true);
// session_start();

require_once $_SERVER['DOCUMENT_ROOT']."/core/inc/mysql.php";

    try {
        $sessionUUID = $_SESSION['uuid'];

        $stmt = $conn->prepare("SELECT username FROM users WHERE uuid = :uuid");
        $stmt->bindParam(':uuid', $sessionUUID);
        $stmt->execute();
        $fetchedUser = $stmt->fetch(PDO::FETCH_ASSOC);
        $playername = $fetchedUser['username'];
    } catch (PDOException $e) {
        echo "Database Error: " . $e->getMessage();
    } catch (Exception $e) {
        error_log("General Error: " . $e->getMessage());
    }

?>
