<?php
// session_start();

function getUserAvatarUrl() {
    if (isset($_SESSION['user_data'])) {
        $user_data = $_SESSION['user_data'];

        // Получение идентификатора пользователя и хэша аватара
        if (isset($user_data['id']) && isset($user_data['avatar'])) {
            $userId = $user_data['id'];
            $avatarHash = $user_data['avatar'];
            // Формирование URL аватара
            return "https://cdn.discordapp.com/avatars/{$userId}/{$avatarHash}.png"; // Измените расширение на необходимое (png, jpg и т.д.)
        } else {
        }
    } else {
        return 'Ошибка: Нет данных о пользователе в сессии.';
    }
}


function getusernameds() {
    if (isset($_SESSION['user_data'])) {
        $user_data = $_SESSION['user_data'];

        // Получение идентификатора пользователя и хэша аватара
        if (isset($user_data['username'])) {
            $usernameds = $user_data['username'];
            // Формирование URL аватара
            return $usernameds; // Измените расширение на необходимое (png, jpg и т.д.)
        } else {
        }
    } else {
        return 'Ошибка: Нет данных о пользователе в сессии.';
    }
}


function whitelistCheck($pdo, $id) {
    try {
        // Подготовленный запрос для проверки наличия пользователя в таблице whitelist по id
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM whitelist WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Получение результата запроса
        $count = $stmt->fetchColumn();

        // Возвращаем true (1) если найдена запись в whitelist, иначе false (0)
        return ($count > 0) ? true : false;
    } catch (PDOException $e) {
        return false; // В случае ошибки при выполнении запроса
    }
}
?>
