<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
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
<h1>Register New User</h1>
<form id="registerForm" name="registerForm" method="post" action="registrationcontroller.php">
    <label for="nameText">Name: </label>
    <input type="text" id="nameText" name="nameText" /><br />
    <label for="usernameText">Username: </label>
    <input type="text" id="usernameText" name="usernameText" /><br />
    <label for="passwordText">Password: </label>
    <input type="password" id="passwordText" name="passwordText" /><br />
    <label for="emailText">E-mail: </label>
    <input type="text" id="emailText" name="emailText" /><br />
    <input type="submit" name="submitButton" />
</form>
</body>
</html>