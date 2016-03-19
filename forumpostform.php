<?php
session_start();
$errorMessage = "";
if(isset ($_SESSION["error"]))
{
    $errorMessage = $_SESSION["error"];
}
require_once("ForumTopic.php");
require_once("ForumUser.php");
$currentUser = ForumUser::retrieveUserByName($_SESSION["name"]);
if($currentUser == null){
    header("Location: forumtopicmasterpage.php?topicid=" . $_GET["topicid"]);
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
  <title>Create Forum Post</title>
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
<form action="forumpostcontroller.php" method="post" id="forumPostForm">
    <label for="forumPostTitle">Post Title: </label>
    <input type="text" id="forumPostTitle" name="forumPostTitle" />
    <br />
    <label for="forumPostContent">Post Content: </label>
    <textarea form="forumPostForm" id="forumPostContent" name="forumPostContent"></textarea>
    <br />
    <!--To Debug, remove comment on this line, then change input type to "text."
    <label for="currentUserID">Current User ID: </label> -->
    <input type="hidden" value="<?php echo $currentUser->getId();?>" id="currentUserID" name="currentUserID" />
    <!--To Debug, remove comment on this line, then change input type to "text."
    <label for="currentTopicID">Current Topic ID: </label> -->
    <input type="hidden" value="<?php echo $_GET["topicid"];?>" id="currentTopicID" name="currentTopicID" />
    <input type="submit" value="Post Forum Entry" name="submitButton" id="submitButton" />
</form>

</body>
</html>