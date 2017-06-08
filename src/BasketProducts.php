<?php

class BasketProducts
{
    private $basket;
    private $conn;
    private $price;
    private $valueOneProducts;
    private $basketValue;

    public function __construct(PDO $conn)
    {
        $this->basket = array();
        $this->conn = $conn;
        $this->basketValue = 0;
    }

    public function addItem($id, $quantity)
    {
        if ($this->checkQuantity($id, $quantity)) {
            $this->price = $this->getPriceProduct($id);
            $this->valueOneProducts = $this->multiplicationQuantityAndPrice($quantity);
            $this->basket[] = array(
                'id' => $id,
                'quantity' => $quantity,
                'name' => $this->getNameProduct($id),
                'price' => $this->price,
                'value' => $this->valueOneProducts
            );
            $this->basketValue += $this->valueOneProducts;
            $this->price = null;
            $this->valueOneProducts = null;
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
                $this->basketValue -= $position['value'];
                unset($this->basket[$count]);
                return;
            }
            $count++;
        }
        throw new Exception('Nie masz w koszyku takiego produktu');
    }

    public function changeQuantity($id, $quantity)
    {
        $count = 0;
        foreach ($this->basket as $position) {
            if ($position['id'] === $id) {
                $newQuantity = $position['quantity'] + $quantity;
                if ($newQuantity <= 0) {
                    throw new Exception('Po zmianie liczba zamówionych sztuk jest mniejsza niż 0');
                }
                if ($this->checkQuantity($id, $newQuantity)) {
                    $oldValue = $this->basket[$count]['value'];
                    $this->basket[$count]['quantity'] = $newQuantity;
                    $this->basket[$count]['value'] = $this->basket[$count]['quantity'] * $this->basket[$count]['price'];
                    $value = $this->basket[$count]['value'];
                    if ($oldValue > $value) {
                        $diff = $oldValue - $value;
                        $this->basketValue -= $diff;
                    } else if ($oldValue < $value) {
                        $diff = $value - $oldValue;
                        $this->basketValue += $diff;
                    }
                } else {
                    throw new Exception('Proszę zmienić ilość. Przepraszamy ale nie mamy tylu sztuk na stanie');
                }
                return;
            }
            $count++;
        }
        throw new Exception('Nie masz w koszyku takiego produktu');
    }

    public function multiplicationQuantityAndPrice($quantity)
    {
        return $quantity * $this->price;
    }

    public function clearBasket()
    {
        $this->basketValue = 0;
        $this->basket = array();
    }
}