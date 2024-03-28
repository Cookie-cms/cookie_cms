<?php
if (isset($_GET['code'])) {
    $clientId = $discordoauth['client_id'];
    $redirectUri = $discordoauth['redirect_url'];
    $client_secret = $discordoauth['secret_id'];

    $code = $_GET['code'];
    $token_url = 'https://discord.com/api/oauth2/token';

    $data = array(
        'client_id' => $clientId, // Change to $clientId
        'client_secret' => $client_secret,
        'grant_type' => 'authorization_code',
        'code' => $code,
        'redirect_uri' => $redirectUri, // Change to $redirectUri
    );

    $options = array(
        'http' => array(
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ),
    );

    $context = stream_context_create($options);
    $response = file_get_contents($token_url, false, $context);
    $token_data = json_decode($response, true);

    // Get user information from Discord API
    $access_token = $token_data['access_token'];

    $user_url = 'https://discord.com/api/users/@me';

    $user_headers = array(
        'Authorization: Bearer ' . $access_token,
    );

    $user_context = stream_context_create(array(
        'http' => array(
            'header' => $user_headers,
        ),
    ));

    $user_response = file_get_contents($user_url, false, $user_context);
    $user_data = json_decode($user_response, true);

    $_SESSION['user_data'] = $user_data;
    header('Location: /core/auth/discord/login.php');
}
?>