<?php
require_once("Database.php");
require_once("ForumPost.php");
require_once("ForumReplies.php");
use \inf256\Database as Database;
$topicId = $_POST["currentTopicID"];
session_start();
if(isset($_POST["submitButton"]) && isset($_POST["forumPostTitle"]) && isset($_POST["forumPostContent"]) &&
    isset($_POST["currentUserID"]) && isset($_POST["currentTopicID"]))
{

    $userId = $_POST["currentUserID"];

    $postContent = $_POST["forumPostContent"];
    $postTitle = $_POST["forumPostTitle"];
    $db = Database::getInstance();
    $conn = $db->getConnection();
    if($conn->connect_errno)
    {
        die("Died");
    }
    $query = "INSERT INTO forumposts ";
    $query .= "(topicid,userid,posttitle,postcontent,postdate) ";
    $query .= "VALUES (" . $topicId . "," . $userId . ",'" . $postTitle . "','" . $postContent . "',NOW());";
    $conn->query($query);
    $db->closeConnection();
    $_SESSION["error"] = "";
    header("Location: forumtopicmasterpage.php?topicid=" . $topicId);
    exit;
}
else
{
    $_SESSION["error"] = "There was an error submitting your comment. Please try again.<br />" .
        "Make sure all fields are filled out and that you're logged in.<br />" .
        "If the problem persists, contact Brisbin Enterprises Customer Support.";
    header("Location: forumpostform.php?topicid=" . $topicId);
    exit;
}
?>