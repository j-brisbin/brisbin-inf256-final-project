<?php
require_once("ForumPost.php");
require_once("ForumTopic.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="bower_components/webcomponentsjs/HTMLImports.min.js" type="text/javascript"></script>
    <script src="bower_components/webcomponentsjs/CustomElements.min.js" type="text/javascript"></script>
    <script src="js/mainScripts.js" type="text/javascript"></script>
    <link href="css/generalstyles.css" rel="stylesheet" type="text/css" />
    <link rel="import" href="bower_components/polymer/polymer.html" />
    <link rel="import" href="bower_components/paper-card/paper-card.html" />
    <link rel="import" href="bower_components/paper-button/paper-button.html" />
    <link rel="import" href="bower_components/paper-dialog/paper-dialog.html" />
    <link rel="import" href="bower_components/paper-dialog-behavior/paper-dialog-behavior.html"
    <link rel="import" href="bower_components/neon-animation/neon-animations.html" />
    <link rel="import" href="bower_components/iron-flex-layout/iron-flex-layout.html" />
    <link rel="import" href="bower_components/font-roboto/roboto.html" />

    <title>Brisbin Enterprises Forum Home Page</title>
</head>
<body>
<?php
    /*Starts session to check for a user
    who is not logged in but attempts to
    access the user page.*/
    session_start();
    if($_SESSION["nullUserError"] != ""){
        /*Creates a dialog using Polymer telling the user they are not logged in.*/
        echo "<paper-dialog id='userErrorDialog' entry-animation='scale-up-animation' exit-animation='fade-out-animation'>" .
        "<h2>Not Logged In</h2>" .
        "<p>" . $_SESSION["nullUserError"] . "</p>" .
        "</paper-dialog>";
    }
?>
    <h1>Brisbin Enterpises Forum Platform</h1>
</div>
<nav>
    <a href="userpage.php">
        <paper-button raised="">
            See Your Posts
        </paper-button>
    </a>
</nav>
<div id="forumTopics">
    <p>Check Out Our Forum Topics!</p>
    <?php
    $forumTopicsList = ForumTopic::retrieveAllTopicsFromDB();
    for($i = 0; $i < count($forumTopicsList); $i++){
        $query = "?topicid=" . $forumTopicsList[$i]->getId();
        echo "<paper-card>";
        echo "<div class='card-content'>";
        echo "<a href='forumtopicmasterpage.php" . $query . "' >" . $forumTopicsList[$i]->getTopicName() . "</a>";
        echo "</div>";
        echo "</paper-card>";
        echo "<br />";
    }
    ?>
</div>
<footer>
    <a href="login.php">
        <paper-button raised="">
            Login
        </paper-button>
    </a>

    <a href="register.php">
        <paper-button raised="">
            Register
        </paper-button>
    </a>
    <p>&copy;<?php echo date("Y"); ?> Brisbin Enterprises LLC.</p>
</footer>
</body>
</html>