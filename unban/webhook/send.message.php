<?php
    require_once "../index.php";
    $ban = $_POST['ban'];
    $unban = $_POST['unban'];
    
    $webhookurl = "https://discord.com/api/webhooks/901870325074100294/RsOV6LDDCZ9wduBj7Iyk4wsBdHjLfXm-2whKoJ6tCTAm9mL9VJ4JPNZgr4ehYUDJAix3";
    
    $timestamp = date("c", strtotime("now"));
    
    $json_data = json_encode([
        "content" => NULL,       
        "username" => "$user->username",  
        "avatar_url" => "$avatar",
        "tts" => false,
        "embeds" => [
            [
                "title" => "ID: $user->id",
                "type" => "rich",
                "timestamp" => $timestamp,
                "color" => hexdec( "ff5c5c" ),
                "fields" => [
                    [
                        "name" => "Powód twojego bana?",
                        "value" => "$ban",
                        "inline" => false
                    ],
                    [
                        "name" => "Dlaczego mamy cię odbanować?",
                        "value" => "$unban",
                        "inline" => false
                    ]
                ]
            ]
        ]
    
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
    
    
    $ch = curl_init( $webhookurl );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt( $ch, CURLOPT_POST, 1);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt( $ch, CURLOPT_HEADER, 0);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
    
    $response = curl_exec( $ch );
    curl_close( $ch );

    header('Location: https://unban.nedi.me')

?>