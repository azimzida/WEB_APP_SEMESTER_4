<?php

class Database
{
    protected static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection instanceof PDO) {
            return self::$connection;
        }

        $config = require __DIR__ . '/../config/config.php';

        $host = $config['db_host'] ?? '98p348.h.filess.io';
        $port = $config['db_port'] ?? 3307;
        $name = $config['db_name'] ?? 'EDUSHARE_personroof';
        $user = $config['db_user'] ?? 'EDUSHARE_personroof';
        $pass = $config['db_pass'] ?? '26d74fd1cdbba712d3dc22db693849d46783519e';

        $dsn = sprintf('mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4', $host, $port, $name);

        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);

        self::$connection = $pdo;
        return self::$connection;
    }

    public static function testConnection(): bool
    {
        try {
            self::getConnection();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
