<?php

class Invoice
{
    private $date;
    private $id;
    private $orderId;
    private $isPaid;
    private $isIssued;

    public function __construct()
    {
        $this->orderId = null;
        $this->date = date('Y-m-d H:i:s');
        $this->id = -1;
        $this->isIssued = 0;
        $this->isPaid = 0;
    }

    /**
     * @return false|string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param false|string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param mixed $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return int
     */
    public function getisPaid(): int
    {
        return $this->isPaid;
    }

    /**
     * @param int $isPaid
     */
    public function setIsPaid(int $isPaid)
    {
        $this->isPaid = $isPaid;
    }

    /**
     * @return int
     */
    public function getisIssued(): int
    {
        return $this->isIssued;
    }

    /**
     * @param int $isIssued
     */
    public function setIsIssued(int $isIssued)
    {
        $this->isIssued = $isIssued;
    }


}