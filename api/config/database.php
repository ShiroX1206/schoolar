<?php
// This file connects SCHOOlar to the MySQL database.
// Env vars (Docker) with XAMPP-friendly fallbacks: DB_HOST/DB_NAME/DB_USER/DB_PASS.

require_once __DIR__ . "/response.php";

$host = getenv('DB_HOST') ?: "localhost";
$database = getenv('DB_NAME') ?: "schoolar_db";
$username = getenv('DB_USER') ?: "root";
$password = getenv('DB_PASS') !== false ? getenv('DB_PASS') : "";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    sendResponse(array("error" => "Database connection failed. Make sure MySQL is running in XAMPP."), 500);
}

$conn->set_charset("utf8mb4");
?>
