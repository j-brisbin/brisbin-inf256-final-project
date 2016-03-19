<?php
require_once("Database.php");
require_once("ForumPost.php");
require_once("ForumReplies.php");
use \inf256\Database as Database;
$postId = $_POST["currentPostID"];
session_start();
if(isset($_POST["submitButton"]) && isset($_POST["forumReplyContent"]) &&
    isset($_POST["currentUserID"]) && isset($_POST["currentTopicID"]))
{

    $userId = $_POST["currentUserID"];
    $topicId = $_POST["currentTopicID"];
    $replyContent = $_POST["forumReplyContent"];
    $db = Database::getInstance();
    $conn = $db->getConnection();
    if($conn->connect_errno)
    {
        die("Died");
    }
    $query = "INSERT INTO forumreplies ";
    $query .= "(postid,topicid,userid,replycontent,datereplied) ";
    $query .= "VALUES (" . $postId . "," . $topicId . "," . $userId . ",'" . $replyContent . "',NOW());";
    $conn->query($query);
    $db->closeConnection();
    $_SESSION["error"] = "";
    header("Location: forumpostmasterpage.php?postid=" . $postId . "&topicid=" . $topicId);
    exit;
}
else
{
    $_SESSION["error"] = "There was an error submitting your comment. Please try again.<br />" .
        "Make sure all fields are filled out and that you're logged in.<br />" .
        "If the problem persists, contact Brisbin Enterprises Customer Support.";
    header("Location: forumreplyform.php?postid=" . $postId . "&topicid=" . $topicId);
    exit;
}
?>