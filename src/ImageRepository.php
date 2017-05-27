<?php


class ImageRepository
{
    static public function save(PDO $connection, Image $image)
    {
        $imageId = $image->getImageId();
        $productId = $image->getProductId();
        $imageLink = $image->getImageLink();

        if ($imageId == -1) {
            $sql = "INSERT INTO images(productId, imageLink)
                    VALUES (:productId, :imageLink)";
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(":productId", $productId);
            $stmt->bindParam(":imageLink", $imageLink);
            $result = $stmt->execute();
            if ($result == true) {
                return true;
            }
        }
        return false;
    }

    static public function getImageLinksByProduct(PDO $connection, Product $product)
    {
        $linksArray = [];
        $productId = $product->getProductId();
        $sql = "SELECT imageLink FROM images WHERE productId = :productId";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":productId", $productId);
        $stmt->execute();
        while ($link = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $linksArray[] = $link['imageLink'];
        }
        return $linksArray;
    }
}