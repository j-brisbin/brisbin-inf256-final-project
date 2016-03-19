<?php
require_once("ForumPost.php");
require_once("ForumUser.php");
session_start();
$errorMessage = "";
if(isset ($_SESSION["error"]))
{
    $errorMessage = $_SESSION["error"];
}
$currentUser = ForumUser::retrieveUserByName($_SESSION["name"]);
if($currentUser == null){
    header("Location: forumpostmasterpage.php?topicid=" . $_GET["topicid"] . "&postid" . $_GET["postid"]);
    $_SESSION["nullUserError"] = "You are not logged in. Register if you don't have an account, or log in if" .
        " you do have an account.";
}
else{
    $_SESSION["nullUserError"] = "";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Forum Reply</title>
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
<?php
echo "<p>{$errorMessage}</p>";
?>
<form action="forumreplycontroller.php" method="post" id="forumReplyForm">
    <label for="forumReplyContent">Reply Content: </label>
    <textarea form="forumReplyForm" id="forumReplyContent" name="forumReplyContent"></textarea>
    <br />
    <label for="currentUserID">User ID: </label>
    <input type="hidden" value="<?php echo $currentUser->getId();?>" id="currentUserID" name="currentUserID" />
    <input type="hidden" value="<?php echo $_GET["postid"];?>" id="currentPostID" name="currentPostID" />
    <input type="hidden" value="<?php echo $_GET["topicid"];?>" id="currentTopicID" name="currentTopicID" />
    <input type="submit" value="Post Reply" name="submitButton" id="submitButton" />
</form>

</body>
</html>