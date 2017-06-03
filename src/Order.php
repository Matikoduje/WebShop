<?php

class Order
{
    private $id;
    private $orderDate;
    private $orderValue;
    private $userId;

    public function __construct($userId)
    {
        $this->id = -1;
        $this->orderDate = date('Y-m-d H:i:s');
        $this->orderValue = 0;
        $this->userId = $userId;
    }

    /**
     * @return false|string
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * @return int
     */
    public function getOrderValue(): int
    {
        return $this->orderValue;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    public function getId()
    {
        return $this->id;
    }
}