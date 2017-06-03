<?php

class BasketProducts
{
    private $basket;
    private $conn;

    public function __construct(PDO $conn)
    {
        $basket = array();
        $this->conn = $conn;
    }

    public function addItem($id, $quantity)
    {
        if ($this->checkQuantity($id, $quantity)) {
            $this->basket[] = array(
                'id' => $id,
                'quantity' => $quantity,
                'name' => $this->getNameProduct($id),
                'price' => $this->getPriceProduct($id)
            );
        } else {
            throw new Exception('Proszę zmienić ilość. Przepraszamy ale nie mamy tylu sztuk na stanie');
        }
    }

    public function getNameProduct($id)
    {
        return ProductRepository::getProductInfo($this->conn, $id, 'productName');
    }

    public function getPriceProduct($id)
    {
        return ProductRepository::getProductInfo($this->conn, $id, 'productPrice');
    }

    public function checkQuantity($id,$quantity)
    {
        $stock = ProductRepository::getProductInfo($this->conn, $id, 'productQuantity');
        if ($stock >= $quantity) {
            return true;
        }
        return false;
    }

    public function showBasket()
    {
        return $this->basket;
    }

    public function deletePosition($id)
    {
        $count = 0;
        foreach ($this->basket as $position) {
            if ($position['id'] === $id) {
                unset($this->basket[$count]);
            }
            $count++;
        }
    }

    public function changeQuantity($id, $quantity)
    {
        $count = 0;
        foreach ($this->basket as $position) {
            if ($position['id'] === $id) {
                $newQuantity = $position['quantity'] + $quantity;
                if ($this->checkQuantity($id, $newQuantity)) {
                    $this->basket[$count]['quantity'] = $newQuantity;
                } else {
                    throw new Exception('Proszę zmienić ilość. Przepraszamy ale nie mamy tylu sztuk na stanie');
                }
            }
            $count++;
        }
    }
}