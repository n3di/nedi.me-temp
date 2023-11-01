<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    ini_set('max_execution_time', 300); //300 seconds = 5 minutes. In case if your CURL is slow and is loading too much (Can be IPv6 problem)
    error_reporting(E_ALL);
    define('OAUTH2_CLIENT_ID', '901500411159138315');
    define('OAUTH2_CLIENT_SECRET', 'EhD_Qpv2KONOOPMRyN1tMtJuoW9MMVGR');
    $authorizeURL = 'https://discordapp.com/api/oauth2/authorize';
    $tokenURL = 'https://discordapp.com/api/oauth2/token';
    $apiURLBase = 'https://discordapp.com/api/users/@me';
    $revokeURL = 'https://discordapp.com/api/oauth2/token/revoke';
    session_start();

    if((isset($_SESSION['access_token'])) && ($_SESSION['access_token']==true))
    {
        require_once "page/logged.page.php";
    } else {
        require_once "page/logged-out.page.php";
    }

    function apiRequest($url, $post=FALSE, $headers=array()) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($ch);
        if($post)
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        $headers[] = 'Accept: application/json';
        if(session('access_token'))
            $headers[] = 'Authorization: Bearer ' . session('access_token');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        return json_decode($response);
    }
    
    function get($key, $default=NULL) {
        return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
    }

    function session($key, $default=NULL) {
        return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
    }
?>