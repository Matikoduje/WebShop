<?php

function __autoload($className)

{
    include_once '../../src/' . $className . '.php';
}

// w pliku tym zapisana jest mechanika tworzenia zamówienia
// 1. połączenie z bazą danych

$conn = new Connection();
$conn = $conn->doConnect();

/*
 * 2. utworzenie koszyka z zakupami, który poprzez REST API komunikuje się z frontendem.
 *    Można dodawać do niego produkty, usuwać, zmieniać ich ilość
 */

$basket = new BasketProducts($conn);
$basket->addItem(1,10);
$basket->addItem(2,10);
$basket->addItem(3,10);
$basket->addItem(4,10);
$basket->changeQuantity(2,-9);
$basket->deletePosition(1);

/*
 * 3. Po zatwierdzeniu koszyka tworzymy nowy obiekt klasy order.
 *    Mechanika działania jest taka, że po stworzeniu zamówienia musimy go zapisać i znów odczytać.
 *    Wiąże się to z tym, że zapisując produkty do klasy order_products potrzebujemy id od zamówienia.
 *    W konstruktorze przekazuje id od obecnie zalogowanego użytkownika. Następnie potwierdzamy
 *    typ płatności oraz zmieniamy order status na przyjęte
 */

$prepareOrder = new Order(1);
$orderRepository = new OrderRepository();
$orderId = $orderRepository->save($prepareOrder);
unset($prepareOrder);
$order = OrderRepository::loadOrderById($orderId, 1);
$order->choicePaymentMethod(1);
// przy pierwszym użyciu zmieniamy status z null na 1 co oznacza przyjętę
$order->changeOrderStatus();

/*
 * 4. Po wczytaniu zamówienia przekazujemy do metody zamówienia setOrderProducts który zamienia produkty
 *    z koszyka na obiekty klasy order_products. Po wysłaniu wiadomości (brak implementacji tej funkcjonalności).
 *    i potwierdzeniu przez użytkownika zmieniam status na zatwierdzone. W między czasie tworzymy fakturę.
 */

$order->setOrderProducts($basket);
$order->changeOrderStatus();
if ($order->getOrderStatusId() == 2) {
    $invoice = new Invoice();
    $invoice->setOrderId($order->getId());
    $invoiceRepository = new InvoiceRepository();
    $invoiceRepository->save($invoice);
}





