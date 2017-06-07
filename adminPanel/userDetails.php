<?php

require "templates/adminHeader.php";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['userId'])) {
        $user = UserRepository::loadUserById($connection, $_GET['userId']);
    }
}

//TODO: klasa ORDER
?>



<html>
<head>
    <meta charset="UTF-8">
    <title>Karta klienta</title>
</head>

<body>

<h3>Panel Administratora / Karta klienta</h3>

<p>id: <?php echo $user->getUserId(); ?></p>
<p>imię: <?php echo $user->getUserFirstName(); ?></p>
<p>nazwisko: <?php echo $user->getUserLastName(); ?></p>
<p>email: <?php echo $user->getUserEmail(); ?></p>
<p>miasto: <?php echo $user->getAddressCity(); ?></p>
<p>kod pocztowy: <?php echo $user->getAddressCode(); ?></p>
<p>adres: <?php echo $user->getAddressStreet() . " " . $user->getAddressNumber(); ?></p>
<hr>




</body>
</html>

