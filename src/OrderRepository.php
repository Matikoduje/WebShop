<?php

class OrderRepository
{
    protected $conn;
    protected $preparedStatement;

    public function save(Order $order)
    {
        $this->conn = new Connection();
        $this->conn = $this->conn->doConnect();

        if ($order->getId() == -1) {
            try {
                $this->preparedStatement = $this->conn->prepare("INSERT INTO `orders` (`orderDate`,
                `orderValue`, `userId`) VALUES (:orderDate, :orderValue, :userId)");
                $this->preparedStatement->bindValue(':orderDate', $order->getOrderDate());
                $this->preparedStatement->bindValue(':orderValue', $order->getOrderValue());
                $this->preparedStatement->bindValue(':userId', $order->getUserId());
                $this->preparedStatement->execute();
            } catch (PDOException $e) {
                $this->conn = null;
                throw new Exception("Przepraszamy chwilowo mamy problemy z serwerem bazy danych. Proszę spróbować zarejestrować się za chwilę");
            }
        } //else {
//            try {
//                $this->preparedStatement = $this->conn->prepare("UPDATE `users` SET `userFirstName`=:userFirstName,
//                `userLastName`=:userLastName, `userLogin`=:userLogin, `userPassword`=:userPassword,
//                `userEmail`=:userEmail, `addressCity`=:addressCity, `addressCode`=:addressCode,
//                `addressStreet`=:addressStreet, `addressNumber`=:addressNumber WHERE userId=:userId");
//
//                $this->preparedStatement->bindValue(':userId', $user->getUserId());
//                $this->preparedStatement->bindValue(':userFirstName', $user->getUserFirstName());
//                $this->preparedStatement->bindValue(':userLastName', $user->getUserLastName());
//                $this->preparedStatement->bindValue(':userLogin', $user->getUserLogin());
//                $this->preparedStatement->bindValue(':userPassword', $user->getUserPassword());
//                $this->preparedStatement->bindValue(':addressCity', $user->getAddressCity());
//                $this->preparedStatement->bindValue(':addressCode', $user->getAddressCode());
//                $this->preparedStatement->bindValue(':addressNumber', $user->getAddressNumber());
//                $this->preparedStatement->bindValue(':addressStreet', $user->getAddressStreet());
//                $this->preparedStatement->bindValue(':userEmail', $user->getUserEmail());
//
//                $this->preparedStatement->execute();
//            } catch (PDOException $e) {
//                $this->conn = null;
//                throw new Exception("Przepraszamy chwilowo mamy problemy z serwerem bazy danych. Nie można zapisać danych");
//            }
//        }
        $this->conn = null;
    }
}