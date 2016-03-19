<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/2/14
 * Time: 10:13 PM
 */

require_once("Database.php");
use \inf256\Database as Database;


class ForumReplies {
    protected $id;
    protected $postid;
    protected $userid;
    protected $replyContent;
    protected $dateReplied;
    protected $topicid;

    function __construct($id,$postid,$topicid,$userid,$replyContent,$dateReplied)
    {
        $this->dateReplied = $dateReplied;
        $this->id = $id;
        $this->postid = $postid;
        $this->replyContent = $replyContent;
        $this->userid = $userid;
        $this->topicid = $topicid;
    }


    /**
     * @param mixed $dateReplied
     */
    public function setDateReplied($dateReplied)
    {
        $this->dateReplied = $dateReplied;
    }

    /**
     * @return mixed
     */
    public function getDateReplied()
    {
        return $this->dateReplied;
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
     * @param mixed $postid
     */
    public function setPostid($postid)
    {
        $this->postid = $postid;
    }

    /**
     * @return mixed
     */
    public function getPostid()
    {
        return $this->postid;
    }

    /**
     * @param mixed $replyContent
     */
    public function setReplyContent($replyContent)
    {
        $this->replyContent = $replyContent;
    }

    /**
     * @return mixed
     */
    public function getReplyContent()
    {
        return $this->replyContent;
    }

    /**
     * @param mixed $userid
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    }

    /**
     * @return mixed
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @param mixed $userid
     */
    public function setTopicid($topicid)
    {
        $this->topicid = $topicid;
    }

    /**
     * @return mixed
     */
    public function getTopicid()
    {
        return $this->topicid;
    }


    public static function deserialize($result) //$result is an associative array rep. 1 row of db
    {
        $comment = new ForumReplies(
            $result["replyid"],$result["postid"],$result["topicid"],$result["userid"], $result["replycontent"],
            $result["datereplied"]
        );
        return $comment;
    }

    public static function retrieveReplyFromDB($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();
        if($conn->connect_errno){
            return null;
        }
        $result = $conn->query("SELECT * FROM forumreplies WHERE replyid='{$id}' LIMIT 1");
        $object = $result->fetch_assoc();
        if($object){
            $comment = self::deserialize($object);
            $result->close();
            return $comment;
        }
        return null;
    }

    public static function retrieveAllRepliesByPost($postid){
        $replyList = array();
        $db = Database::getInstance();
        $connection = $db->getConnection();
        if($connection->connect_errno)
        {
            return null;
        }
        $result = $connection->query("SELECT * FROM forumreplies WHERE postid={$postid}");
        if($result)
        {
            while($obj = $result->fetch_assoc()){
                $replyList[] = self::deserialize($obj);
            }
            $result->close();
        }
        return $replyList;
    }

    public static function retrieveAllRepliesByUser($userid){
        $replyList = array();
        $db = Database::getInstance();
        $connection = $db->getConnection();
        if($connection->connect_errno)
        {
            return null;
        }
        $result = $connection->query("SELECT * FROM forumreplies WHERE userid={$userid}");
        if($result)
        {
            while($obj = $result->fetch_assoc()){
                $replyList[] = self::deserialize($obj);
            }
            $result->close();
        }
        return $replyList;
    }


    /**
     * Retrieves all addresses from the given Database as PHP Address Objects
     * @return array of Address
     */
    public static function retrieveAllRepliesFromDB()
    {
        $replyList = array();
        $db = Database::getInstance();
        $connection = $db->getConnection();
        if($connection->connect_errno)
        {
            return null;
        }
        $result = $connection->query("SELECT * FROM forumreplies");
        if($result)
        {
            while($obj = $result->fetch_assoc()){
                $replyList[] = self::deserialize($obj);
            }
            $result->close();
        }
        return $replyList;

    }

    function __toString(){
        return $this->id . ", " . $this->postid . ", " . $this->userid . ", " . $this->replyContent . ", " .
        $this->dateReplied;
    }
} 