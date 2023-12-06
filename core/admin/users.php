<?php
try {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/core/inc/mysql.php";

    // Assuming you have an active database connection stored in $conn

    // Prepare and execute the query to fetch users
    $stmt = $conn->query("SELECT id,username, dsid, uuid, perm FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the users array
    return;
    
} catch (PDOException $e) {
    // Handle any potential database errors here
    // Log or display an error message
    // Returning an empty array in case of an error
    return [];
}
?>
