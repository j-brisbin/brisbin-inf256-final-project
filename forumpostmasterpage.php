<?php
require_once("ForumPost.php");
require_once("ForumReplies.php");
require_once("ForumTopic.php");
require_once("ForumUser.php");
session_start();
$errorMessage = "";
if(isset($_POST["error"])){
    echo $errorMessage = $_POST["error"];
}
$postQuery = "?postid=" . $_GET["postid"] . "&topicid=" . $_GET["topicid"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Brisbin Enterprises Forum Platform - Forum Post</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="bower_components/webcomponentsjs/HTMLImports.min.js" type="text/javascript"></script>
    <script src="bower_components/webcomponentsjs/CustomElements.min.js" type="text/javascript"></script>
    <link href="css/generalstyles.css" rel="stylesheet" type="text/css" />
    <link rel="import" href="bower_components/polymer/polymer.html" />
    <link rel="import" href="bower_components/paper-card/paper-card.html" />
    <link rel="import" href="bower_components/paper-button/paper-button.html" />
    <link rel="import" href="bower_components/iron-flex-layout/iron-flex-layout.html" />
    <link rel="import" href="bower_components/font-roboto/roboto.html" />
</head>
<body>
<header>
    <h1>Brisbin Enterprises Forum Platform</h1>
    <nav>
        <a href="index.php">
            <paper-button raised="">
                Back to Other Topics
            </paper-button>
        </a>
        <a href="<?php echo "forumtopicmasterpage.php" . "?topicid=" . $_GET["topicid"]; ?>">
            <paper-button raised="">
                Back to Other Posts in This Topic
            </paper-button>
        </a>
        <a href="<?php echo "forumreplyform.php" . $postQuery?>">
            <paper-button raised="">
                Reply To This Post
            </paper-button>
        </a>
    </nav>
</header>
<div id="forumPost">
    <?php
    if(isset($_GET["postid"]) && isset($_GET["topicid"]))
    {
        $obtainedPost = ForumPost::retrievePostFromDB($_GET["postid"]);
        $obtainedPostReplies = ForumReplies::retrieveAllRepliesByPost($_GET["postid"]);
        $obtainedTopic = ForumTopic::retrieveTopicFromDBById($_GET["topicid"]);
        $postUser = ForumUser::retrieveUserFromDBById($obtainedPost->getUserid());
        echo "<paper-card heading='" . $postUser->getUsername() . "'>";
        echo "<div class='card-content'>";
        echo "<p>{$obtainedPost->getPostContent()}</p>";
        echo "<p>Posted on: {$obtainedPost->getPostdate()}</p>";
        echo "</div>";
        echo "</paper-card>";
        echo "<br />";
    }
    else{
        if(isset($_SESSION["username"])){
            header("Location: userpage.php");
            exit;
        }
        else{
            header("Location: index.php");
            exit;
        }
    }
    ?>
</div>
<?php
$obtainedPostUser = "";
for($i=0;$i<count($obtainedPostReplies);$i++){
    $obtainedPostUser = ForumUser::retrieveUserFromDBById($obtainedPostReplies[$i]->getUserId());
    echo "<h4>{$obtainedPostUser->getUsername()}</h4>";
    echo "<p>{$obtainedPostReplies[$i]->getReplyContent()} - {$obtainedPostReplies[$i]->getDateReplied()}</p>";
}
?>
</body>
</html>