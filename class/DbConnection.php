<?php

class DbConnection
{
    private static ?PDO $db = null;

    private function __construct()
    {
        // singleton
    }

    public static function getDb()
    {
        $db = parse_ini_file(dirname(__DIR__)  .'/config/database.ini');
        $type = $db['type'];
        $name = $db['name'];
        $host = $db['host'];
        $user = $db['user'];
        $password = $db['password'];

        if (!self::$db) {
            self::$db = new PDO($type . ':dbname=' . $name . ';host=' . $host . ';charset=utf8mb4', $user, $password);
        }

        return self::$db;
    }
}

// $mydb = DbConnection::getDb();
// var_dump($mydb);
