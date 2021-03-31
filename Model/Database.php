<?php
namespace PhPKnights\Model;

class Database
{
    //properties
    private static $user = 'hughesbu_bryan_hughes';
    private static $pass = 'xsSt(3rtE2uk$y';
    private static $dsn = 'mysql:host=167.114.195.192;dbname=hughesbu_PHPKNIGHTS_ASSIGNMENT';
    private static $dbcon;

    private function __construct()
    {
    }

    //get pdo connection
    public static function getDb()
    {
        if (!isset(self::$dbcon)) {
            try {
                self::$dbcon = new \PDO(self::$dsn, self::$user, self::$pass);
                self::$dbcon->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$dbcon->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
            } catch (\PDOException $e) {
                $msg = $e->getMessage();
                include 'logs/custom-error.php';
                exit();
            }
        }

        return self::$dbcon;
    }
}