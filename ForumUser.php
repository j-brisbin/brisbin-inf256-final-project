<?php
/**
 * Created by PhpStorm.
 * User: brisbij
 * Date: 3/20/14
 * Time: 1:09 PM
 */
require_once("Database.php");
use \inf256\Database as Database;


class ForumUser {
    protected $userid;
    protected $name;
    protected $username;
    protected $email;
    protected $hashedpassword;
    protected $datejoined;
    protected $privelege;
    protected $confirmed;

    function __construct($id, $name, $username, $email, $hashedpassword, $datejoined, $privelege, $confirmed)
    {
        $this->confirmed = $confirmed;
        $this->email = $email;
        $this->hashedpassword = $hashedpassword;
        $this->id = $id;
        $this->name = $name;
        $this->datejoined = $datejoined;
        $this->privelege = $privelege;
        $this->username = $username;
    }

    /**
     * @param mixed $confirmed
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;
    }

    /**
     * @return mixed
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $hashedpassword
     */
    public function setHashedPassword($hashedpassword)
    {
        $this->hashedpassword = $hashedpassword;
    }

    /**
     * @return mixed
     */
    public function getHashedPassword()
    {
        return $this->hashedpassword;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $privelege
     */
    public function setPrivelege($privelege)
    {
        $this->privelege = $privelege;
    }

    /**
     * @return mixed
     */
    public function getPrivelege()
    {
        return $this->privelege;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }
    public static function deserialize($result) //$result is an associative array rep. 1 row of db
    {
        $user = new ForumUser(
            $result["userid"],$result["name"],$result["username"],
            $result["email"],$result["hashedpassword"], $result["datejoined"],
            $result["privilege"], $result["confirmed"]
        );
        return $user;
    }

    public static function retrieveUserFromDB($username){
        $db = Database::getInstance();
        $conn = $db->getConnection();
        if($conn->connect_errno){
            return null;
        }
        $result = $conn->query("SELECT * FROM forumusers WHERE username='{$username}' LIMIT 1");
        $object = $result->fetch_assoc();
        if($object){
            $user = self::deserialize($object);
            $result->close();
            return $user;
        }
        return null;
    }

    public static function retrieveUserFromDBById($userid){
        $db = Database::getInstance();
        $conn = $db->getConnection();
        if($conn->connect_errno){
            return null;
        }
        $result = $conn->query("SELECT * FROM forumusers WHERE userid='{$userid}' LIMIT 1");
        $object = $result->fetch_assoc();
        if($object){
            $user = self::deserialize($object);
            $result->close();
            return $user;
        }
        return null;
    }


    public static function retrieveUserByName($name){ //$result is an associative array rep. 1 row of db
        $db = Database::getInstance();
        $conn = $db->getConnection();
        if($conn->connect_errno){
            return null;
        }
        $result = $conn->query("SELECT * FROM forumusers WHERE name='{$name}' LIMIT 1");
        $object = $result->fetch_assoc();
        if($object){
            $user = self::deserialize($object);
            $result->close();
            return $user;
        }
        return null;
    }

    /**
     * Retrieves all addresses from the given Database as PHP Address Objects
     * @return array of Address
     */
    public static function retrieveAllUsersFromDB()
    {
        $userList = array();
        $db = Database::getInstance();
        $connection = $db->getConnection();
        if($connection->connect_errno)
        {
            return null;
        }
        $result = $connection->query("SELECT * FROM users");
        if($result)
        {
            while($obj = $result->fetch_assoc()){
                $userList[] = self::deserialize($obj);
            }
            $result->close();
        }
        return $userList;

    }

    function __toString(){
        return $this->userid . ", " . $this->name . ", " . $this->username . ", " . $this->email .
        ", " . $this->hashedpassword . ", " . $this->datejoined . ", " . $this->privelege;
    }
} 