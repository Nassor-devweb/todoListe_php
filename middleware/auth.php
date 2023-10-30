<?php

$path = __DIR__;
$path = str_replace("\middleware", "", $path);

function createSession()
{
    $path = __DIR__;
    $path = str_replace("\middleware", "", $path);
    if (!session_id()) {
        session_start([
            "save_path" => $path . "\session",
            'gc_maxlifetime' => 60 * 60 * 24, // 1 jour
            'use_strict_mode' => true,
            'use_only_cookies' => true,
            'cookie_lifetime' => 60 * 60 * 24, // 1 jour
            'cookie_httponly' => true,
            'cookie_samesite' => 'Lax'
        ]);
        session_regenerate_id(true);
        return true;
    }
    return false;
}

function authQuerry()
{
    if (session_id() && isset($_SESSION["id_user"])) {
        return true;
    }
    return false;
}

function desconnected()
{
    session_unset();
    session_destroy();
    setcookie(session_name(), "", 0, null, null, false, true);
    // header("Location: user/signin_user");
}
