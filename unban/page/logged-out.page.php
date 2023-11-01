<?php
    if(get('action') == 'login') {
        $params = array(
            'client_id' => OAUTH2_CLIENT_ID,
            'redirect_uri' => 'https://unban.nedi.me',
            'response_type' => 'code',
            'scope' => 'identify guilds email'
        );
        // Redirect the user to Discord's authorization page
        header('Location: https://discordapp.com/api/oauth2/authorize' . '?' . http_build_query($params));
        die();
    }

    if(get('code')) {
        // Exchange the auth code for a token
        $token = apiRequest($tokenURL, array(
            "grant_type" => "authorization_code",
            'client_id' => OAUTH2_CLIENT_ID,
            'client_secret' => OAUTH2_CLIENT_SECRET,
            'redirect_uri' => 'https://unban.nedi.me',
            'code' => get('code')
        ));
        $logout_token = $token->access_token;
        $_SESSION['access_token'] = $token->access_token;
        header('Location: ' . $_SERVER['PHP_SELF']);
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masz bana u Duudziaa?</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://nedi.me/assets/css/unban/index.css">
</head>
<body>
    <section class="logged-out-container">
        <h1>Masz bana u Duudziaa?</h1>
        <h2>Napisz prośbę o unbana!</h2>
        <button class="login-button" onclick="login()">Zaloguj się&nbsp;przez Discorda</button>
    </section>
<script src="https://nedi.me/assets/js/unban/index.js"></script>
</body>
</html>