<?php
require "templates/adminHeader.php";
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Lista zamówień</title>
</head>

<body>

<h3>Panel Administratora / lista zamówień</h3>

<?php
$ordersArray = OrderRepository::loadAllOrders($connection);
echo "<table>";
    echo "<tr>";
        echo "<td>Id zamówienia</td>";
        echo "<td>Data zamówienia</td>";
        echo "<td>Nr faktury</td>";
        echo "<td>Imię</td>";
        echo "<td>Nazwisko</td>";
        echo "<td>Email</td>";
    echo "</tr>";
foreach ($ordersArray as $order) {
    echo "<tr>";
        echo "<td>" . $order->getId() . "</td>";
        echo "<td>" . $order->getOrderDate() . "</td>";
        echo "<td>" . $order->getInvoiceNumber() . "</td>";
        echo "<td>" . $order->getInvoiceDate() . "</td>";
        echo "<td>" . UserRepository::loadUserById($connection, $order->getUserId())->getUserFirstName() . "</td>";
        echo "<td>" . UserRepository::loadUserById($connection, $order->getUserId())->getUserLastName() . "</td>";
        echo "<td>" . UserRepository::loadUserById($connection, $order->getUserId())->getUserEmail() . "</td>";
        echo "<td><a href='orderDetails.php?orderId=" . $order->getId() . "'>przejdź do szczegółów</a></td>";
    echo "</tr>";
}
echo "</table>";
?>

</body>
</html>



