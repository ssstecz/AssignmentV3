<?php
namespace Salvio\Scandiweb\Control;

// Connection to the Database
class DbConn
{
    private static $instance;
    private $connection;
    private function __construct()
    {
        try {
            $dsn = 'mysql:host=localhost;dbname=id20764116_scwta_s01';
            $username = 'id20764116_salvio';            
            $password = 'Scandiweb#01';
            $this->connection = new \PDO($dsn, $username, $password);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
           echo "Connection to database failed, please try again. <br>" . $e->getMessage();
        }
    }
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new DbConn();
        }
        return self::$instance;
    }
    public function getConn()
    {
        return $this->connection;
    }
}