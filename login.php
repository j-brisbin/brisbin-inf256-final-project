<?php
$errorMessage = "";
if(isset($_GET["error"]))
{
    $errorMessage = $_GET["error"];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Brisbin Enterprises Blog Login Page</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href="css/generalstyles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div>
    <?php echo $errorMessage; ?>
</div>
<form action="logincontroller.php" method="post">
    <label for="usernameText">User Name: </label>
    <input type="text" id="usernameText" name="usernameText" /><br />
    <label for="passwordText">Password: </label>
    <input type="password" id="passwordText" name="passwordText" /><br />
    <input type="submit" value="Login" id="submitButton" name="submitButton" />
</form>
</body>
</html>