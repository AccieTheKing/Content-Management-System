<?php

namespace Cms\Utils;
use mysqli;

class Database
{
    private static $conn;

    public static function getConn()
    {
        if (static::$conn == null) {
            static::$conn = new mysqli($_ENV['SERVER'], $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD'], $_ENV['MYSQL_DATABASE']);
        }

        if (static::$conn->connect_error) {
            die("Connection error: " . static::$conn->connect_error);
        }

        return static::$conn;
    }
}
