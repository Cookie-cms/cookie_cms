<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

$alertDanger = '';

// Get the step number from the URL parameter
$step = isset($_GET['s']);

// Handle different steps based on the step number
if ($step == 1) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ip = $_POST["ip"];
        $username = $_POST["ipusername"];
        $port = $_POST["port"];
        $db_password = $_POST["db_password"];
        $database = $_POST["database"];
        $type = $_POST["typeregister"];
        $capetype = $_POST["capetype"];
        // $template = $_POST["tamplate"];
        $template ="bootstrap";
        $presetup = true;
        $hwid = isset($_POST["hwid"]) ? $_POST["hwid"] : 0;

        try {
            $conn = new PDO('mysql:host=' . $ip . ';port=' . $port, $username, $db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $createDbSql = 'CREATE DATABASE IF NOT EXISTS ' . $database;
            $conn->exec($createDbSql);

            $conn = new PDO('mysql:host=' . $ip . ';port=' . $port . ';dbname=' . $database, $username, $db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $conn->exec('USE ' . $database);

            $importSql = "
            CREATE TABLE `users` (
                `id` int NOT NULL AUTO_INCREMENT,
                `username` varchar(255) NOT NULL,
                `password` varchar(255) NOT NULL,
                `perm` int NOT NULL DEFAULT '1',
                PRIMARY KEY (`id`)
            )";

            $conn->exec($importSql);
            echo "Example data imported successfully<br>";

            $dbConnContent = <<<CONFIG
<?php

\$host = "$ip";
\$username = "$username";
\$pass = "{$db_password}";
\$db = "{$database}";
\$port = {$port};

\$registertype = "{$type}"; 
\$minecraftsys = $presetup;
\$capetype = "{$capetype}";
\$template = "{$template}";


\$modules = [];
\$DEBUG = [
    'debug' => false,
    'development' => false,
    'generatorusername' => false
];

\$discordsys = 0;
\$discordoauth = [
    'client_id' => "{$clientid}",
    'secret_id' => "{$secretid}",
    'scopes' => '{$scopes}',
    'redirect_url' => "{$redirecturl}",
    'bot' => "",
    'guild_id' => 0,
    'role' => 0
];
?>
CONFIG;

            if (file_put_contents('../core/configs/config.inc.php', $dbConnContent)) {
                echo "/core/configs/config.inc.php created successfully<br>";
            } else {
                $alertDanger = "Error creating /core/configs/config.inc.php";
            }

            if ($presetup) {
                $addColumnSql = 'ALTER TABLE users ADD COLUMN uuid CHAR(36) UNIQUE DEFAULT NULL, ADD COLUMN accessToken CHAR(32) DEFAULT NULL, ADD COLUMN serverID VARCHAR(41) DEFAULT NULL, ADD COLUMN hwidId BIGINT DEFAULT NULL';

                $stmt = $conn->prepare($addColumnSql);
                $stmt->execute();
                echo "Presetup columns added successfully<br>";

                if ($allowCreateAdmin) {
                    header("Location: /setup/step2.php?alertgood=Example data imported successfully<br>db_conn.php created successfully<br>Presetup columns added successfully<br>hwid columns added successfully");
                    exit;
                } else {
                    $alertDanger = "User is not allowed to create an admin";
                }
            }

            if ($hwid) {
                $hwidSql = "
                    CREATE TABLE `hwids` (
                        `id` bigint(20) NOT NULL,
                        `publickey` blob,
                        `hwDiskId` varchar(255) DEFAULT NULL,
                        `baseboardSerialNumber` varchar(255) DEFAULT NULL,
                        `graphicCard` varchar(255) DEFAULT NULL,
                        `displayId` blob,
                        `bitness` int(11) DEFAULT NULL,
                        `totalMemory` bigint(20) DEFAULT NULL,
                        `logicalProcessors` int(11) DEFAULT NULL,
                        `physicalProcessors` int(11) DEFAULT NULL,
                        `processorMaxFreq` bigint(11) DEFAULT NULL,
                        `battery` tinyint(1) NOT NULL DEFAULT '0',
                        `banned` tinyint(1) NOT NULL DEFAULT '0',
                        PRIMARY KEY (`id`),
                        UNIQUE KEY `publickey` (`publickey`(255))
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                ";
            
                $conn->exec($hwidSql);
                echo "Table 'hwids' created successfully<br>";
            
                $alterHwidSql = "
                    ALTER TABLE `hwids`
                    MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
                ";
            
                $conn->exec($alterHwidSql);
                echo "'id' column modified successfully<br>";
            
                $alterUsersSql = "
                    ALTER TABLE `users`
                    ADD CONSTRAINT `users_hwidfk` FOREIGN KEY (`hwidId`) REFERENCES `hwids` (`id`);
                ";
            
                $conn->exec($alterUsersSql);
                echo "Foreign key constraint added successfully<br>";
            
                echo "hwid columns added and foreign key established successfully<br>";
            
            }
        } catch (PDOException $e) {
            $alertDanger = "Error: " . $e->getMessage();
        }
    } else {
        $alertDanger = "Invalid request method";
    }
} elseif ($step == 2) {
    // Code for Step 3
    // ...

    // Redirect to the next step or finish setup
    header("Location: /setup/index.php?alertdanger=" . urlencode($alertDanger));
    exit;
} elseif ($step == 3) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['re_password'])) {
            $username = validate($_POST['username_owner']);
            $pass = validate($_POST['password_owner']);
            $re_pass = validate($_POST['re_password_owner']);

            if (strlen($username) < 4 || !preg_match('/^[A-Za-z0-9_]+$/', $username)) {
                echo "Username should be at least 4 characters long and contain only English keyboard characters.";
                exit();
            }

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
                // ... Further logic for SELECT or INSERT into 'users'
            } catch (PDOException $e) {
                echo "An error occurred during registration. Please try again later.";
                error_log("PDOException: " . $e->getMessage(), 0);
                exit();
            }
        } else {
            echo "Missing username, password, or re-entered password.";
            exit();
        }
    } else {
        $alertDanger = "Invalid request method for Step 3";
        header("Location: /setup/index.php?alertdanger=" . urlencode($alertDanger));
        exit();
    }
};

    
    // header("Location: /setup/?s=4");
    exit;
?>
