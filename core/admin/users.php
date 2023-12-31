<?php
// require_once $_SERVER['DOCUMENT_ROOT'] . "/define.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/core/inc/mysql.php";

// Assuming you have an active database connection stored in $conn

// Prepare and execute the query to fetch users
$stmt = $conn->query("SELECT id,username, dsid, uuid, perm FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the users array
return;

?>
