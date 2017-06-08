<?php

class Order
{
    private $id;
    private $orderDate;
    private $orderValue;
    private $userId;
    private $isOrderConfirmed;
    private $isOrderEdited;
    private $paymenthMethodId;
    private $orderStatusId;
    private $orderProducts;
    private $orderRepository;

    public function __construct($userId, $orderDate = null, $orderValue = null, $id = null)
    {

        if ($id === null) {
            $this->id = -1;
        } else {
            $this->id = $id;
        }

        if ($orderDate === null) {
            $this->orderDate = date('Y-m-d H:i:s');
        } else {
            $this->orderDate = $orderDate;
        }

        if ($orderValue === null) {
            $this->orderValue = 0;
        } else {
            $this->orderValue = $orderValue;
        }

        $this->orderRepository = new OrderRepository();
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getOrderStatusId()
    {
        return $this->orderStatusId;
    }


    /**
     * @param mixed $orderStatusId
     */
    public function setOrderStatusId($orderStatusId)
    {
        $this->orderStatusId = $orderStatusId;
    }

    /**
     * @param mixed $isOrderEdited
     */
    public function setIsOrderEdited($isOrderEdited)
    {
        $this->isOrderEdited = $isOrderEdited;
    }

    /**
     * @param mixed $isOrderConfirmed
     */
    public function setIsOrderConfirmed($isOrderConfirmed)
    {
        $this->isOrderConfirmed = $isOrderConfirmed;
    }

    /**
     * @return false|string
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * @return float
     */
    public function getOrderValue(): float
    {
        return $this->orderValue;
    }

    /**
     * @param mixed $paymenthMethodId
     */
    public function setPaymenthMethodId($paymenthMethodId)
    {
        $this->paymenthMethodId = $paymenthMethodId;
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

    public function setOrderProducts(BasketProducts $basket)
    {
        if ($this->id !== -1) {
            $basketProducts = $basket->showBasket();
            foreach ($basketProducts as $product) {
                if (!$basket->checkQuantity($product['id'], $product['quantity'])) {
                    throw new Exception('Niestety nie mamy tylu sztuk ' . $product['name']);
                }
            }

            $this->orderProducts = array();
            foreach ($basketProducts as $product) {
                $orderProduct = new OrderProducts((int)$this->id);
                $orderProduct->setProductId($product['id']);
                $orderProduct->setPrice((float)$product['price']);
                $orderProduct->setQuantity($product['quantity']);
                $orderProduct->setValue($product['value']);
                $this->orderValue += $product['value'];
                $this->orderProducts[] =$orderProduct;
            }

            $repositoryOrderProducts = new OrderProductsRepository();
            foreach ($this->orderProducts as $orderProduct) {
                $repositoryOrderProducts->save($orderProduct);
            }

            $this->orderRepository->updateValue($this->getId(), $this->getOrderValue());

        } else {
            throw new Exception('Najpierw należy zapisać zamówienie');
        }
    }

    public function choicePaymentMethod($paymentId)
    {
        if ($paymentId == 1 || $paymentId == 2) {
            $this->setPaymenthMethodId($paymentId);
            $this->orderRepository->setPayment($this->getId(), $paymentId);
        } else {
            throw new Exception('Wybrano nie prawidłowy typ płatności');
        }
    }

    public function changeOrderStatus()
    {
        if ($this->orderStatusId == null) {
            $this->orderStatusId = 1;
        } else if ($this->orderStatusId == 1) {
            $this->orderStatusId = 2;
        } else if ($this->orderStatusId == 2) {
            $this->orderStatusId = 3;
        } else {
            throw new Exception('Nie prawidłowy status zamówienia');
        }

        $this->orderRepository->setOrderStatus($this->id,$this->orderStatusId);
    }

}