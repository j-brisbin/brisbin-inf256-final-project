<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/31/14
 * Time: 8:09 PM
 */

require_once("Database.php");
use \inf256\Database as Database;


class ForumPost {

    protected $id;
    protected $topicid;
    protected $userid;
    protected $postTitle;
    protected $postContent;
    protected $postdate;

    function __construct($id, $postContent, $postTitle, $postdate, $topicid, $userid)
    {
        $this->id = $id;
        $this->postContent = $postContent;
        $this->postTitle = $postTitle;
        $this->postdate = $postdate;
        $this->topicid = $topicid;
        $this->userid = $userid;
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
     * @param mixed $postContent
     */
    public function setPostContent($postContent)
    {
        $this->postContent = $postContent;
    }

    /**
     * @return mixed
     */
    public function getPostContent()
    {
        return $this->postContent;
    }

    /**
     * @param mixed $postTitle
     */
    public function setPostTitle($postTitle)
    {
        $this->postTitle = $postTitle;
    }

    /**
     * @return mixed
     */
    public function getPostTitle()
    {
        return $this->postTitle;
    }

    /**
     * @param mixed $postdate
     */
    public function setPostdate($postdate)
    {
        $this->postdate = $postdate;
    }

    /**
     * @return mixed
     */
    public function getPostdate()
    {
        return $this->postdate;
    }

    /**
     * @param mixed $topicid
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


    public static function deserialize($result) //$result is an associative array rep. 1 row of db
    {
        $post = new ForumPost(
            $result["postid"],$result["postcontent"], $result["posttitle"], $result["postdate"], $result["topicid"],
            $result["userid"]
        );
        return $post;
    }

    public static function retrievePostFromDB($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();
        if($conn->connect_errno){
            return null;
        }
        $result = $conn->query("SELECT * FROM forumposts WHERE postid='{$id}'");
        $object = $result->fetch_assoc();
        if($object){
            $post = self::deserialize($object);
            $result->close();
            return $post;
        }
        return null;
    }

    public static function retrievePostsFromDBByUser($userid){
        $postList = array();
        $db = Database::getInstance();
        $connection = $db->getConnection();
        if($connection->connect_errno)
        {
            return null;
        }
        $result = $connection->query("SELECT * FROM forumposts where userid='{$userid}'");
        if($result)
        {
            while($obj = $result->fetch_assoc()){
                $postList[] = self::deserialize($obj);
            }
            $result->close();
        }
        $db->closeConnection();
        return $postList;
    }

    public static function retrievePostsFromDBByTopic($topicid){
        $postList = array();
        $db = Database::getInstance();
        $connection = $db->getConnection();
        if($connection->connect_errno)
        {
            return null;
        }
        $result = $connection->query("SELECT * FROM forumposts where topicid='{$topicid}'");
        if($result)
        {
            while($obj = $result->fetch_assoc()){
                $postList[] = self::deserialize($obj);
            }
            $result->close();
        }
        $db->closeConnection();
        return $postList;
    }

    public static function retrieveAllPostsFromDB()
    {
        $postList = array();
        $db = Database::getInstance();
        $connection = $db->getConnection();
        if($connection->connect_errno)
        {
            return null;
        }
        $result = $connection->query("SELECT * FROM forumposts");
        if($result)
        {
            while($obj = $result->fetch_assoc()){
                $postList[] = self::deserialize($obj);
            }
            $result->close();
        }
        $db->closeConnection();
        return $postList;

    }

    function __toString(){
        return $this->id . ", " . $this->topicid . ", " . $this->userid . ", " . $this->postTitle .
        ", " . $this->postContent . ", " . $this->postdate;
    }


} 