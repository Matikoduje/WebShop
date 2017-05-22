<?php

require_once "templates/adminHeader.php";

?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
</head>
<body>

    <form method="POST" action="adminLogin.php">
        <h3>Strona logowania Administratora</h3>
        <div>email administratora: </div><input name="adminEmail" type="email">
        <div>login administratora: </div><input name="adminLogin" type="text">
        <div>hasło administratora: </div><input name="adminPassword" type="password">
        <input type="submit" value="wyślij">
    </form>

</body>
</html>