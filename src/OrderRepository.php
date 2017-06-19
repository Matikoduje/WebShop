<?php

class OrderRepository
{

    public static function prepareConnection()
    {
        $conn = new Connection();
        $conn = $conn->doConnect();
        return $conn;
    }

    public function save(Order $order)
    {
        $conn = $this->prepareConnection();

        if ($order->getId() == -1) {
            try {
                $preparedStatement = $conn->prepare("INSERT INTO `orders` (`orderDate`,
                `orderValue`, `userId`) VALUES (:orderDate, :orderValue, :userId)");
                $preparedStatement->bindValue(':orderDate', $order->getOrderDate());
                $preparedStatement->bindValue(':orderValue', $order->getOrderValue());
                $preparedStatement->bindValue(':userId', $order->getUserId());
                $preparedStatement->execute();
                return $conn->lastInsertId();
            } catch (PDOException $e) {
                $conn = null;
                throw new Exception("Przepraszamy chwilowo mamy problemy z serwerem bazy danych. Proszę spróbować zarejestrować się za chwilę");
            }
        }
        $conn = null;
    }

    public static function loadOrderById($id, $userId)
    {
        $conn = self::prepareConnection();

        try {
            $preparedStatement = $conn->prepare("SELECT * FROM `orders` WHERE orderId=:id");
            $preparedStatement->bindParam(':id', $id);
            $preparedStatement->execute();
            if ($preparedStatement->rowCount()) {
                $row = $preparedStatement->fetch();
                if ($userId != $row['userId']) {
                    throw new Exception('Użytkownik nie ma uprawnień do zobaczenia zamówienia');
                }

                $order = new Order($row['userId'], $row['orderDate'], $row['orderValue'], $row['orderId']);
                $order->setIsOrderConfirmed($row['isOrderConfirmed']);
                $order->setIsOrderEdited($row['isOrderEdited']);
                $order->setPaymenthMethodId($row['paymentMethodId']);
                $order->setOrderStatusId($row['orderStatusId']);
                $conn = null;
                return $order;
            } else {
                $conn = null;
                throw new Exception('Nie ma zamówienia o podanym id');
            }
        } catch (PDOException $e) {
            $conn = null;
            throw new Exception('Nie można wczytać danych z tabeli');
        }
    }

    public function updateValue($orderId, $orderValue)
    {
        $conn = $this->prepareConnection();

        try {
            $preparedStatement = $conn->prepare("UPDATE `orders` SET `orderValue`=:orderValue WHERE orderId=:orderId");
            $preparedStatement->bindParam(':orderId', $orderId);
            $preparedStatement->bindParam(':orderValue', $orderValue);
            $preparedStatement->execute();
            $conn = null;
        } catch (PDOException $e) {
            $conn = null;
            throw new Exception('Nie można zapisać danych do tabeli');
        }
    }

    public function setPayment($orderId, $paymentId)
    {
        $conn = $this->prepareConnection();

        try {
            $preparedStatement = $conn->prepare("UPDATE `orders` SET `paymentMethodId`=:paymentId WHERE orderId=:orderId");
            $preparedStatement->bindParam(':orderId', $orderId);
            $preparedStatement->bindParam(':paymentId', $paymentId);
            $preparedStatement->execute();
            $conn = null;
        } catch (PDOException $e) {
            $conn = null;
            throw new Exception('Nie można zapisać danych do tabeli');
        }
    }

    public function setOrderStatus($orderId, $statusId)
    {
        $conn = $this->prepareConnection();

        try {
            $preparedStatement = $conn->prepare("UPDATE `orders` SET `orderStatusId`=:statusId WHERE orderId=:orderId");
            $preparedStatement->bindParam(':orderId', $orderId);
            $preparedStatement->bindParam(':statusId', $statusId);
            $preparedStatement->execute();
            $conn = null;
        } catch (PDOException $e) {
            $conn = null;
            throw new Exception('Nie można zapisać danych do tabeli');
        }
    }

    public static function loadAllOrders(PDO $connection)
    {
        $sql = "SELECT * FROM orders";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $ordersArray = [];
        while ($item = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $order = new Order($item['userId']);
            $order->setOrderId($item['orderId']);
            $order->setUserId($item['userId']);
            $order->setOrderStatusId($item['orderStatusId']);
            $order->setPaymenthMethodId($item['paymentMethodId']);
            $order->setOrderDate($item['orderDate']);
            $order->setIsOrderEdited($item['isOrderEdited']);
            $order->setIsOrderConfirmed($item['isOrderConfirmed']);
            $order->setIsInvoiceIssued($item['isInvoiceIssued']);
            $order->setIsInvoicePaid($item['isInvoicePaid']);
            $order->setInvoiceNumber($item['invoiceNumber']);
            $order->setInvoiceDate($item['invoiceDate']);
            $ordersArray[] = $order;
        }
        return $ordersArray;

    }

    public static function loadAllOrdersByUserId (PDO $connection, $userId)
    {
        $sql = "SELECT * FROM orders WHERE userId = :userId";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        $ordersArray = [];
        while ($item = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $order = new Order($userId);
            $order->setOrderId($item['orderId']);
            $order->setUserId($item['userId']);
            $order->setOrderStatusId($item['orderStatusId']);
            $order->setPaymenthMethodId($item['paymentMethodId']);
            $order->setOrderDate($item['orderDate']);
            $order->setIsOrderEdited($item['isOrderEdited']);
            $order->setIsOrderConfirmed($item['isOrderConfirmed']);
            $order->setIsInvoiceIssued($item['isInvoiceIssued']);
            $order->setIsInvoicePaid($item['isInvoicePaid']);
            $order->setInvoiceNumber($item['invoiceNumber']);
            $order->setInvoiceDate($item['invoiceDate']);
            $ordersArray[] = $order;
        }
        return $ordersArray;

    }

    public static function loadOrderByOrderId (PDO $connection, $orderId)
    {
        $sql = "SELECT * FROM orders WHERE orderId = :orderId";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":orderId", $orderId);
        $stmt->execute();
        while ($item = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $order = new Order($item['userId']);
            $order->setOrderId($item['orderId']);
            $order->setUserId($item['userId']);
            $order->setOrderStatusId($item['orderStatusId']);
            $order->setPaymenthMethodId($item['paymentMethodId']);
            $order->setOrderDate($item['orderDate']);
            $order->setIsOrderEdited($item['isOrderEdited']);
            $order->setIsOrderConfirmed($item['isOrderConfirmed']);
            $order->setIsInvoiceIssued($item['isInvoiceIssued']);
            $order->setIsInvoicePaid($item['isInvoicePaid']);
            $order->setInvoiceNumber($item['invoiceNumber']);
            $order->setInvoiceDate($item['invoiceDate']);
        }
        return $order;
    }

    public static function updateOrder(PDO $connection, Order $order)
    {
        $userId = $order->getUserId();
        $orderStatusId = $order->getOrderStatusId();
        $paymentMethodId = $order->getPaymenthMethodId();
        $orderDate = $order->getOrderDate();
        $isOrderEdited = $order->getIsOrderEdited();
        $isOrderConfirmed = $order->getIsOrderConfirmed();
        $isInvoiceIssued = $order->getIsInvoiceIssued();
        $isInvoicePaid = $order->getIsInvoicePaid();
        $invoiceNumber = $order->getInvoiceNumber();
        $invoiceDate = $order->getInvoiceDate();
        $orderId = $order->getId();
        $sql = "UPDATE orders SET userId = :userId,
                                  orderStatusId = :orderStatusId,
                                  paymentMethodId = :paymentMethodId,
                                  orderDate = :orderDate,
                                  isOrderEdited = :isOrderEdited,
                                  isOrderConfirmed = :isOrderConfirmed,
                                  isInvoiceIssued = :isInvoiceIssued,
                                  isInvoicePaid = :isInvoicePaid,
                                  invoiceNumber = :invoiceNumber,
                                  invoiceDate = :invoiceDate
                    WHERE orderId = :orderId";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":userId", $userId);
        $stmt->bindParam(":orderStatusId", $orderStatusId);
        $stmt->bindParam(":paymentMethodId", $paymentMethodId);
        $stmt->bindParam(":orderDate", $orderDate);
        $stmt->bindParam(":isOrderEdited", $isOrderEdited);
        $stmt->bindParam(":isOrderConfirmed", $isOrderConfirmed);
        $stmt->bindParam(":isInvoiceIssued", $isInvoiceIssued);
        $stmt->bindParam(":isInvoicePaid", $isInvoicePaid);
        $stmt->bindParam(":invoiceNumber", $invoiceNumber);
        $stmt->bindParam(":invoiceDate", $invoiceDate);
        $stmt->bindParam(":orderId", $orderId);
        $stmt->execute();
        $order = OrderRepository::loadOrderByOrderId($connection, $order->getId());
        return $order;
    }
}