<?php
    require "templates/adminHeader.php";
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Lista klientów sklepu</title>
</head>

<body>

<h3>Panel Administratora / lista klientów sklepu</h3>

<?php
$usersArray = UserRepository::loadAllUsers($connection);
echo "<table>";
echo "<tr>";
echo "<td>Id</td>";
echo "<td>Email</td>";
echo "<td>Imię</td>";
echo "<td>Nazwisko</td>";
echo "<td>Miejscowść</td>";
echo "</tr>";
foreach ($usersArray as $user) {
    echo "<tr>";
    echo "<td>" . $user->getUserId() . "</td>";
    echo "<td>" . $user->getUserEmail() . "</td>";
    echo "<td>" . $user->getUserFirstName() . "</td>";
    echo "<td>" . $user->getUserLastName() . "</td>";
    echo "<td>" . $user->getAddressCity() . "</td>";
    echo "<td><a href='userDetails.php?userId=" . $user->getUserId() . "'>przejdź do szczegółów</a></td>";
    echo "</tr>";
}
echo "</table>";
?>

</body>
</html>



