<?php

class ProductCategory
{
    private $productCategoryId;
    private $productCategoryName;

    public function __construct()
    {
        $this->productCategoryId = -1;
        $this->productCategoryName = "";
    }

    public function getProductCategoryId(): int
    {
        return $this->productCategoryId;
    }

    public function setProductCategoryId(int $productCategoryId)
    {
        $this->productCategoryId = $productCategoryId;
    }

    public function getProductCategoryName(): string
    {
        return $this->productCategoryName;
    }

    public function setProductCategoryName(string $productCategoryName)
    {
        $this->productCategoryName = $productCategoryName;
    }

}