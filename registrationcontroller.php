<?php
require_once("Database.php");
require_once("MyEncryption.php");
require_once("ForumUser.php");
use \inf256\Database as Database;

if(isset($_POST["nameText"]) && isset($_POST["emailText"]) &&
    isset($_POST["usernameText"]) && isset($_POST["passwordText"]) && isset($_POST["submitButton"]))
{
    $name = $_POST["nameText"];
    $email = $_POST["emailText"];
    $username = $_POST["usernameText"];
    $password = $_POST["passwordText"];
    $user = ForumUser::retrieveUserFromDB($username);
    $db = Database::getInstance();
    $conn = $db->getConnection();
    if($conn->connect_errno)
    {
        die("Died");
    }
    $query = "INSERT INTO forumusers ";
    $query .= "(name,username,email,hashedpassword,datejoined,privilege,confirmed) ";
    $query .= "VALUES ('" . $name . "','" . $username . "','" . $email . "',";
    $query .= "'" . MyEncryption::password_encrypt($password) . "', NOW(), 'user',0)";
    $return = $conn->query($query);
    $errorMessage = urlencode("Congratulations! You have successfully registered! Login below!");
    header("Location: login.php?error={$errorMessage}");
}
else
{
    $_SESSION["error"] = "There has been an error registering. Please make sure all fields are filled.<br />" .
        "If the problem persist, contact Brisbin Enterprises Customer Support.";
    header("Location: register.php");
    exit;
}
?>