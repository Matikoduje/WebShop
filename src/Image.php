<?php


class Image
{
    private $imageId;
    private $productId;
    private $imageLink;

    public function __construct()
    {
        $this->imageId = -1;
        $this->productId = -1;
        $this->imageLink = "";
    }

    public function getImageId(): int
    {
        return $this->imageId;
    }

    public function setImageId(int $imageId)
    {
        $this->imageId = $imageId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId)
    {
        $this->productId = $productId;
    }

    public function getImageLink(): string
    {
        return $this->imageLink;
    }

    public function setImageLink(string $imageLink)
    {
        $this->imageLink = $imageLink;
    }

}