<?php

require "templates/adminHeader.php";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['userId'])) {
        $user = UserRepository::loadUserById($connection, $_GET['userId']);
    }
}
?>


<html>
<head>
    <meta charset="UTF-8">
    <title>Karta klienta</title>
</head>

<body>

<h3>Panel Administratora / Karta klienta</h3>

<p>
    <?php
    echo "id: ". $user->getUserId() . "<br>";
    echo "imię: ". $user->getUserFirstName() . "<br>";
    echo "nazwisko: ". $user->getUserLastName() . "<br>";
    echo "email: ". $user->getUserEmail() . "<br>";
    echo "miasto: ". $user->getAddressCity() . "<br>";
    echo "kod pocztowy: ". $user->getAddressCode() . "<br>";
    echo "adres: ". $user->getAddressStreet() . " " . $user->getAddressNumber() . "<br>";
    ?>
</p>
<hr>

<p>Lista zamówień klienta:</p>


<?php

    $orders = OrderRepository::loadAllOrdersByUserId($connection, $user->getUserId());

    echo "<table>";
        echo "<tr>";
            echo "<td>Id zamówienia</td>";
            echo "<td>Data zamówienia</td>";
            echo "<td>Nr faktury</td>";
            echo "<td>Data faktury</td>";
        echo "</tr>";
        foreach ($orders as $order) {
            echo "<tr>";
                echo "<td>" . $order->getId() . "</td>";
                echo "<td>" . $order->getOrderDate() . "</td>";
                echo "<td>" . $order->getInvoiceNumber() . "</td>";
                echo "<td>" . $order->getInvoiceDate() . "</td>";
                echo "<td><a href='orderDetails.php?orderId=" . $order->getId() . "'>szczegóły zamówienia</a></td>";
            echo "</tr>";
        }
    echo "</table>";

?>



</body>
</html>

