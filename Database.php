<?php
/**
 * Created by PhpStorm.
 * User: brisbij
 * Date: 2/25/14
 * Time: 12:27 PM
 */

namespace inf256;
use mysqli;


class Database {
    protected $connection;
    protected static $_instance;
    /**
     * Get an instance of the database
     * @return database instance
     */
    public static function getInstance(){
        if(!self::$_instance)
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    protected function __construct(){
        $this->connection = new mysqli(/*Your database information goes here.*/);
        if(mysqli_connect_error())
        {
            trigger_error("Failed to connect to MySQL: " . mysqli_connect_error(),E_USER_ERROR);
        }
    }

    private function __clone(){} //prevent clone magic duplication

    public function getConnection(){
        return $this->connection;
    }

    public function closeConnection(){
        return $this->connection->close();
    }
} 