<?php
namespace Salvio\Scandiweb\Control;

require_once $basedir . "autoload.php";
use Salvio\Scandiweb\Control\DbConn;

// Database connection sharing
class DbResource
{
    protected $connection;
    public function __construct()
    {
        $this->connection = DbConn::getInstance()->getConn();
    }
    public function sharedConnection()
    {
        return $this->connection;
    }
}