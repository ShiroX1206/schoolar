<?php
// Server-side page guard. Include at the VERY TOP of every protected page
// (before ANY HTML output). From public/user and public/admin the path is:
//   require_once __DIR__ . "/../../api/config/guard.php";
//   require_page_auth("user");   // or "admin" for admin pages
// NOTE: never put a PHP close tag inside a comment in this file.
// This is what actually stops "just visit this html and gain access".
// javascript/auth-check.js is only a UX nicety — it can be bypassed with
// view-source / curl, so the server must enforce access.

require_once __DIR__ . "/session.php";
schoolar_session_start();

function require_page_auth($requiredRole)
{
    // Never cache protected pages (back-button after logout shows nothing).
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: SAMEORIGIN");

    $loggedIn = isset($_SESSION["user_id"]);
    $role = isset($_SESSION["role"]) ? $_SESSION["role"] : null;

    if (!$loggedIn || $role !== $requiredRole) {
        // $requiredRole is "user" or "admin" — send them to the right login.
        // Browser UI now lives under public/ (XAMPP: http://localhost/SCHOOlar/public/...;
        // Docker: DocumentRoot is public/, so pages are at web root).
        $uri = isset($_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_URI"] : "";
        if (strpos($uri, "/SCHOOlar/public") === 0) {
            $base = "/SCHOOlar/public"; // XAMPP canonical public tree
        } elseif (strpos($uri, "/SCHOOlar") === 0) {
            $base = "/SCHOOlar/public"; // XAMPP legacy /SCHOOlar/User|Admin bookmark
        } else {
            $base = ""; // Docker serves public/ at web root
        }
        $login = $requiredRole === "admin" ? $base . "/admin/admin-login.html" : $base . "/login.html";
        header("Location: " . $login, true, 302);
        exit;
    }
}
