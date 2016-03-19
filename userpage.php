<?php
require_once("ForumUser.php");
require_once("ForumPost.php");
require_once("ForumReplies.php")
?>

<!DOCTYPE html>
<html>
<head>
  <title>Brisbin Enterpises Forum Platform - User Page</title>
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
    <h1>Brisbin Enterpises Forum Platform - User Page</h1>
    <nav>
        <a href="index.php">
            <paper-button raised="">
                Back to Other Topics
            </paper-button>
        </a>
        <a href='logoutcontroller.php'>
            <paper-button raised=''>
                Log Out
            </paper-button>
        </a>
    </nav>
</header>

<div>
    <?php
    session_start();
    /*Checks for a valid user.*/
    $name = $_SESSION["name"];
    $user = ForumUser::retrieveUserByName($name);
    /*User is sent back to homepage if the user does
    not exist.*/
    if($user == null){
        header("Location: index.php");
        $_SESSION["nullUserError"] = "You are not logged in. Register if you don't have an account, or log in if" .
            " you do have an account.";
    }
    else{
        $_SESSION["nullUserError"] = "";
    }

    echo "<h1>Welcome to your user page {$name}!</h1>";
    echo "";
    ?>
</div>
<div id="forumPosts">
    <?php
    $forumPostsList = ForumPost::retrievePostsFromDBByUser($user->getId());
    for($i = 0; $i < count($forumPostsList); $i++){
        $query = "?topicid=" . $forumPostsList[$i]->getTopicid() . "&postid=" . $forumPostsList[$i]->getID();
        echo "<a href='forumpostmasterpage.php" . $query . "'><paper-card>" . $forumPostsList[$i]->getPostTitle() . "
        </paper-card></a><br />";
    }
    ?>
</div>
</body>
</html>