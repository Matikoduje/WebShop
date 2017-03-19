<?php


class Item
{
    private $itemID;
    private $itemName;
    private $itemPrice;
    private $itemDescription;
    private $itemQuantity;

    public function __construct()
    {
        $this->id = -1;
        $this->itemName = "";
        $this->itemPrice = "";
        $this->itemDescription = "";
        $this->itemQuantity = 0;
    }

    public function getItemID()
    {
        return $this->itemID;
    }

    public function getItemName()
    {
        return $this->itemName;
    }

    public function getItemPrice()
    {
        return $this->itemPrice;
    }

    public function getItemDescription()
    {
        return $this->itemDescription;
    }

    public function getItemQuantity()
    {
        return $this->itemQuantity;
    }

    public function setItemName(string $itemName)
    {
        $this->itemName = $itemName;
    }

    public function setItemPrice(string $itemPrice)
    {
        $this->itemPrice = $itemPrice;
    }

    public function setItemDescription(string $itemDescription)
    {
        $this->itemDescription = $itemDescription;
    }

    public function changeItemQuantity($quantity) {
        $this->itemQuantity += $quantity;
    }


}