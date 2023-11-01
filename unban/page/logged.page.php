<?php
    if(get('action') == 'logout') {
        apiRequest($revokeURL, array(
            'token' => session('access_token'),
            'client_id' => OAUTH2_CLIENT_ID,
            'client_secret' => OAUTH2_CLIENT_SECRET,
        ));
        unset($_SESSION['access_token']);
        header('Location: https://unban.nedi.me/logout.php');
        die();
    }

    if(session('access_token')) {
        $user = apiRequest($apiURLBase);
        $avatar = 'https://cdn.discordapp.com/avatars/'.$user->id.'/'.$user->avatar;
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Napisz prośbę o unbana!</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://nedi.me/assets/css/unban/index.css">
</head>
<body>
    <section class="logged-in-container">
        <section class="top-bar">
            <section class="user">
                <span class="user-username">
                    <span class="user-prefix">Zalogowano jako</span>
                    <?php
                        echo '<strong>'.$user->username.'</strong>';
                    ?>
                </span>
                <section class="avatar">
                    <?php
                        echo '<img src="'.$avatar.'" alt="Avatar">';
                    ?>
                </section>
            </section>
            <button class="logout-button" onclick="logout()">Wyloguj się</button>
        </section>
        <h1>Napisz prośbę o unbana!</h1>
        <form action="webhook/send.message.php" method="post">
            <label>
            <span class="field-label">Powód twojego bana</span>
            <textarea name="ban" class="form-area"></textarea>
            </label>
            <label>
            <span class="field-label">Dlaczego mamy cię odbanować?</span>
            <textarea name="unban" class="form-area"></textarea>
            </label>
            <button class="submit-button" name="action" value="Submit">Wyślij prośbę</button>
        </form>
    </section>
<script src="https://nedi.me/assets/js/unban/index.js"></script>
</body>
</html>