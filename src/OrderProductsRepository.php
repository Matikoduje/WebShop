<?php

class OrderProductsRepository
{
    public static function prepareConnection()
    {
        $conn = new Connection();
        $conn = $conn->doConnect();
        return $conn;
    }

    public function save(OrderProducts $orderProducts)
    {
        $conn = $this->prepareConnection();

        if ($orderProducts->getId() == -1) {
            try {
                $preparedStatement = $conn->prepare("INSERT INTO `order_products` (`orderId`,
                `productId`, `orderProductQuantity`, `orderProductPrice`, `orderProductValue`)
                VALUES (:orderId, :productId, :orderProductQuantity, :orderProductPrice, :orderProductValue)");
                $preparedStatement->bindValue(':orderId', $orderProducts->getOrderId());
                $preparedStatement->bindValue(':productId', $orderProducts->getProductId());
                $preparedStatement->bindValue(':orderProductQuantity', $orderProducts->getQuantity());
                $preparedStatement->bindValue(':orderProductPrice', $orderProducts->getPrice());
                $preparedStatement->bindValue(':orderProductValue', $orderProducts->getValue());
                $preparedStatement->execute();
            } catch (PDOException $e) {
                $conn = null;
                throw new Exception("Przepraszamy chwilowo mamy problemy z serwerem bazy danych");
            }
        }
    }

    public static function loadOrderProductsByOrderId(PDO $connection, $orderId)
    {
        $sql = "SELECT * FROM order_products WHERE orderId = :orderId";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':orderId', $orderId);
        $stmt->execute();
        $orderProductsArray =[];
        while ($item = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $orderProducts = new OrderProducts($orderId);
            $orderProducts->setId($item['orderProductId']);
            $orderProducts->setQuantity($item['orderProductQuantity']);
            $orderProducts->setPrice($item['orderProductPrice']);
            $orderProducts->setValue($item['orderProductValue']);
            $orderProducts->setProductId($item['productId']);
            $orderProductsArray[] = $orderProducts;
        }
        return $orderProductsArray;
    }
}