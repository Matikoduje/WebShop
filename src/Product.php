<?php

class Product
{
    private $productId;
    private $productName;
    private $productPrice;
    private $productDescription;
    private $productCategory;
    private $productQuantity;

    public function __construct()
    {
        $this->productId = -1;
        $this->productName = "";
        $this->productPrice = "";
        $this->productDescription = "";
        $this->productCategory = "";
        $this->productQuantity = 0;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    public function getProductName()
    {
        return $this->productName;
    }

    public function setProductName($productName)
    {
        $this->productName = $productName;
    }

    public function getProductPrice()
    {
        return $this->productPrice;
    }

    public function setProductPrice($productPrice)
    {
        $this->productPrice = $productPrice;
    }

    public function getProductDescription()
    {
        return $this->productDescription;
    }

    public function setProductDescription($productDescription)
    {
        $this->productDescription = $productDescription;
    }

    public function getProductCategory()
    {
        return $this->productCategory;
    }

    public function setProductCategory($productCategory)
    {
        $this->productCategory = $productCategory;
    }

    public function getProductQuantity()
    {
        return $this->productQuantity;
    }

    public function setProductQuantity($productQuantity)
    {
        $this->productQuantity = $productQuantity;
    }
}
