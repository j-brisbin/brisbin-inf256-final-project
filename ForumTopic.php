<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/23/14
 * Time: 8:45 PM
 */

require_once("Database.php");
use inf256\Database as Database;

class ForumTopic {
    protected $id;
    protected $topicName;

    function __construct($id, $topicName)
    {
        $this->id = $id;
        $this->topicName = $topicName;
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
     * @param mixed $topicName
     */
    public function setTopicName($topicName)
    {
        $this->topicName = $topicName;
    }

    /**
     * @return mixed
     */
    public function getTopicName()
    {
        return $this->topicName;
    }

    public static function deserialize($result) //$result is an associative array rep. 1 row of db
    {
        $topic = new ForumTopic(
            $result["topicid"],$result["topicname"]
        );
        return $topic;
    }

    public static function retrieveTopicFromDBById($topicid){
        $db = Database::getInstance();
        $conn = $db->getConnection();
        if($conn->connect_errno){
            return null;
        }
        $result = $conn->query("SELECT * FROM forumtopics WHERE topicid='{$topicid}' LIMIT 1");
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
    public static function retrieveAllTopicsFromDB()
    {
        $topicList = array();
        $db = Database::getInstance();
        $connection = $db->getConnection();
        if($connection->connect_errno)
        {
            return null;
        }
        $result = $connection->query("SELECT * FROM forumtopics");
        if($result)
        {
            while($obj = $result->fetch_assoc()){
                $topicList[] = self::deserialize($obj);
            }
            $result->close();
        }
        return $topicList;

    }

    function __toString()
    {
        return $this->id . ", " . $this->topicName;
    }


} 