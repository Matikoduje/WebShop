<?php


require "templates/adminHeader.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['orderId']) && isset($_POST['isConfirmed']) && isset($_POST['isEdited']) && isset($_POST['isInvoiceIssued']) && isset($_POST['isInvoicePaid'])) {
        $order = OrderRepository::loadOrderByOrderId($connection, $_POST['orderId']);
        $order->setIsOrderConfirmed($_POST['isConfirmed']);
        $order->setIsOrderEdited($_POST['isEdited']);
        $order->setIsInvoiceIssued($_POST['isInvoiceIssued']);
        $order->setIsInvoicePaid($_POST['isInvoicePaid']);
        $newOrder = OrderRepository::updateOrder($connection, $order);
        if ($newOrder) {
            echo "pomyślnie zmodyfikowano zamówienie";
        } else {
            echo "niestety, nie zmodyfikowałeś zamówienia";
        }
    }
}

echo "<br>";
echo "<a href='orderDetails.php?orderId=" . $_POST['orderId'] . "'>powrót do strony zmodyfikowanego zamówienia</a>";

?>