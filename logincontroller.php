<?php
require_once("Database.php");
require_once("MyEncryption.php");
require_once("ForumUser.php");
use \inf256\Database as Database;

if (isset($_POST["submitButton"])) {
    $username = $_POST["usernameText"];
    $password = $_POST["passwordText"];
    $user = ForumUser::retrieveUserFromDB($username);
    $hashed = $user->getHashedPassword();
    $temp = crypt($password, $hashed);
    $check = MyEncryption::password_check($password, $user->getHashedpassword());
    if ($check && $user->getUsername() == $username) {
        //start a new session, retrieves from the server the current session id if already started
        //or creates and sends a new session id variable
        session_start();
        $_SESSION["loggedin"] = "OK";
        $_SESSION["name"] = $user->getName();
        $_SESSION["username"] = $user->getUsername();
        $_SESSION["userid"] = $user->getId();
        header("Location: userpage.php");
        exit;
    } else {
        $errorMessage = urlencode("The given credentials do not match. Please try again.");
        header("Location: login.php?error={$errorMessage}");
        exit;
    }
} else {
    $errorMessage = urlencode("You submitted a blank field. Please try again.");
    header("Location: login.php?error={$errorMessage}");
    exit;
}
?>