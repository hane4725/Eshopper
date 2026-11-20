<?php
/**
 * Cấu hình đường dẫn và hằng số toàn cục
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Định nghĩa đường dẫn thư mục gốc
define('ROOT_PATH', dirname(__DIR__));

// Tự động nhận diện Base URL
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)) ? "https://" : "http://";
$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
$scriptDir = isset($_SERVER['SCRIPT_NAME']) ? dirname($_SERVER['SCRIPT_NAME']) : '';
$baseUrl = rtrim($protocol . $host . str_replace('\\', '/', $scriptDir), '/');

if (substr($baseUrl, -6) === '/admin') {
    $baseUrl = substr($baseUrl, 0, -6);
}

define('BASE_URL', $baseUrl);

/**
 * Hàm hỗ trợ chuyển hướng
 */
function redirect($url) {
    header("Location: " . $url);
    exit();
}

/**
 * Hàm hiển thị thông báo flash
 */
function setFlash($key, $message) {
    $_SESSION['flash_' . $key] = $message;
}

function getFlash($key) {
    if (isset($_SESSION['flash_' . $key])) {
        $msg = $_SESSION['flash_' . $key];
        unset($_SESSION['flash_' . $key]);
        return $msg;
    }
    return null;
}
