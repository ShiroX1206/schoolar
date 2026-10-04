<?php
// Central session bootstrap. Include this FIRST in every PHP entry point
// instead of calling session_start() directly.

function schoolar_session_start()
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');

    // Hardened cookie: HttpOnly + SameSite=Lax, Secure when on HTTPS.
    // PHP 7.3+ array syntax for setcookie params.
    session_set_cookie_params(array(
        'lifetime' => 0,            // session cookie (dies with browser)
        'path'     => '/',
        'domain'   => '',
        'secure'   => $isHttps,    // true on HTTPS, false on local http
        'httponly' => true,
        'samesite' => 'Lax',
    ));

    // Harden session behaviour (ignored on some shared hosts, safe to set).
    @ini_set('session.use_only_cookies', '1');
    @ini_set('session.use_strict_mode', '1');
    @ini_set('session.cookie_httponly', '1');
    @ini_set('session.use_trans_sid', '0');

    session_start();

    // Idle timeout: 2 hours.
    $timeout = 7200;
    if (isset($_SESSION['last_activity']) && (time() - (int)$_SESSION['last_activity'] > $timeout)) {
        $_SESSION = array();
        if (ini_get('session.use_cookies')) {
            $p = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
        }
        session_destroy();
        session_start();
    }
    $_SESSION['last_activity'] = time();

    // Bind session to user-agent + first /24 of IP to blunt session hijack.
    // If it mismatches, wipe the session (user just has to log in again).
    $fingerprint = md5(
        (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'unknown') . '|' .
        substr(isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0', 0, strrpos(isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0', '.') ?: 0)
    );
    if (!isset($_SESSION['fingerprint'])) {
        $_SESSION['fingerprint'] = $fingerprint;
    } elseif (!hash_equals((string)$_SESSION['fingerprint'], $fingerprint)) {
        $_SESSION = array();
        if (ini_get('session.use_cookies')) {
            $p = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
        }
        session_destroy();
        session_start();
        $_SESSION['last_activity'] = time();
        $_SESSION['fingerprint'] = $fingerprint;
    }
}
