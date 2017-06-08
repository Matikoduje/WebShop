<?php

class OrderRepository
{

    static public function prepareConnection()
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

    static public function loadOrderById($id, $userId)
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
}