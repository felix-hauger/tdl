<?php

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'database.php';

class DbConnection
{
    private static ?PDO $db = null;

    private function __construct()
    {
        // singleton
    }

    public static function getDb()
    {
        $type = DB_TYPE;
        $name = DB_NAME;
        $host = DB_HOST;
        $charset = DB_CHARSET;
        $user = DB_USER;
        $password = DB_PASSWORD;

        if (!self::$db) {
            self::$db = new PDO($type . ':dbname=' . $name . ';host=' . $host . ';charset=' . $charset, $user, $password);
        }

        self::$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return self::$db;
    }
}

// $mydb = DbConnection::getDb();
// var_dump($mydb);
