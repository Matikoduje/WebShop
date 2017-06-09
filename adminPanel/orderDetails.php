<?php

require "templates/adminHeader.php";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['orderId'])) {
        $order = OrderRepository::loadOrderByOrderId($connection, $_GET['orderId']);
    }
}

?>


<html>
<head>
    <meta charset="UTF-8">
    <title>Karta zamówienia</title>
</head>

<body>

<h3>Panel Administratora / Karta zamówienia</h3>

<p>
    <?php
    echo "id zamówienia: ". $order->getId() . "<br>";
    echo "data zamówienia: ". $order->getOrderDate() . "<br>";
    echo "id użytkownika (klienta): ". $order->getUserId() . "<br>";
    echo "potwierdzone?: ". $order->getIsOrderConfirmed() . "<br>";
    echo "edytowane?: ". $order->getIsOrderEdited() . "<br>";
    echo "id sposobu płatności: ". $order->getPaymenthMethodId() . "<br>";
    echo "faktura wystawiona?: ". $order->getIsInvoiceIssued() . "<br>";
    echo "faktura zapłacona?: ". $order->getIsInvoicePaid() . "<br>";
    echo "nr faktury: ". $order->getInvoiceNumber() . " " . "<br>";
    echo "data faktury: ". $order->getInvoiceDate() . " " . "<br>";
    ?>
</p>
<hr>
<p> Lista zakupów</p>

<?php
    $orderId = $order->getId();
    $orderProducts = OrderProductsRepository::loadOrderProductsByOrderId($connection, $orderId);
    echo "<table>";
        echo "<tr>";
            echo "<td>Nazwa produktu</td>";
            echo "<td>Ilość</td>";
            echo "<td>Cena jednostkowa</td>";
            echo "<td>Wartość</td>";
        echo "</tr>";
    foreach ($orderProducts as $orderProduct) {
        echo "<tr>";
            echo "<td>" . ProductRepository::loadProductById($connection, $orderProduct->getProductId())->getProductName() . "</td>";
            echo "<td>" . $orderProduct->getQuantity() . "</td>";
            echo "<td>" . $orderProduct->getPrice() . "</td>";
            echo "<td>" . $orderProduct->getValue() . "</td>";
        echo "</tr>";
    }
    echo "</table>";
?>

<hr>

<form action="orderUpdated.php" method="post">
    <p>Uaktualnij zamówienie</p>
    <p>czy zamówienie zostało potwierdzone</label> <input name="isConfirmed" type="number"></p>
    <p>czy zamówienie jest w trakcie edycji <input name="isEdited" type="number"></p>
    <p>czy faktura została wystawiona <input name="isInvoiceIssued" type="number"></p>
    <p>czy faktura została zapłacona <input name="isInvoicePaid" type="number"></p>
    <?php echo "<input type='hidden' name='orderId' value='$orderId' />" ?>
    <input type="submit" value="zapisz">
</form>

