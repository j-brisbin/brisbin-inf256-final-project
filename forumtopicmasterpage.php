<?php
require_once("ForumPost.php");
require_once("ForumReplies.php");
require_once("ForumTopic.php");
session_start();
$errorMessage = "";
if(isset($_POST["error"])){
    echo $errorMessage = $_POST["error"];
}
$topicQuery = "?topicid=" . $_GET["topicid"];
$obtainedTopic = ForumTopic::retrieveTopicFromDBById($_GET["topicid"]);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Brisbin Enterprises Forum Platform - Topic Page</title>
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
    <?php echo "<h3>{$obtainedTopic->getTopicName()}</h3>"; ?>
    <nav>
        <a href="index.php">
            <paper-button raised="">
                Back to Other Topics
            </paper-button>
        </a>
        <a href="<?php echo "forumpostform.php" . $topicQuery?>">
            <paper-button raised="">
                Post To This Topic
            </paper-button>
        </a>
    </nav>
</header>
<div id="forumPosts">
    <?php
    if(isset($_GET["topicid"]))
    {
        echo "<h1></h1>";
        $topicPosts = ForumPost::retrievePostsFromDBByTopic($_GET["topicid"]);
        for($i = 0;$i < count($topicPosts);$i++){
            $query = "?topicid=" . $_GET["topicid"] . "&postid=" . $topicPosts[$i]->getID();
            echo "<paper-card heading='" . $topicPosts[$i]->getPostTitle() . "'>";
            echo "<div class='card-content'>";
            echo "<a href='forumpostmasterpage.php" . $query . "'>"
                . "Posted on: " . $topicPosts[$i]->getPostdate() . "</a><br />";
            echo "</div>";
            echo "</paper-card>";
            echo "<br />";
        }
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
</body>
</html>