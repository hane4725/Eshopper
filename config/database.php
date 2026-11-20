<?php
/**
 * Cấu hình kết nối Cơ sở dữ liệu MySQL bằng PDO
 */
class Database {
    private static $host = 'localhost';
    private static $port = '3306';
    private static $db_name = 'webbanpc';
    private static $username = 'root';
    private static $password = '';
    private static $conn = null;
    private static $connectionError = null;

    public static function getConnection() {
        if (self::$conn === null) {
            try {
                $dsn = "mysql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$db_name . ";charset=utf8mb4";
                self::$conn = new PDO($dsn, self::$username, self::$password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_CASE => PDO::CASE_NATURAL
                ]);
            } catch (PDOException $e) {
                self::$connectionError = $e->getMessage();
                return null;
            }
        }
        return self::$conn;
    }

    public static function getError() {
        return self::$connectionError;
    }
}
