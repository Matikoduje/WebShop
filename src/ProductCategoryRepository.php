<?php

class ProductCategoryRepository
{
    static public function save(PDO $connection, ProductCategory $category)
    {
        $id = $category->getProductCategoryId();
        $name = $category->getProductCategoryName();

        if ($id == -1) {
            $sql = "INSERT INTO products_category (productCategoryName)
                    VALUES (:name)";
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(":name", $name);
            $stmt->execute();
            $categoryId = $connection->lastInsertId();
            $category = new ProductCategory();
            $category->setProductCategoryId($categoryId);
            $category->setProductCategoryName(ProductCategoryRepository::loadProductCategoryById($connection,$categoryId)->getProductCategoryName());
            return $category;
        } elseif ($id != -1) {
            $sql = "UPDATE products_category SET productCategoryName = :name
                    WHERE productCategoryId = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":name", $name);
            $stmt->execute();
            return ProductCategoryRepository::loadProductCategoryById($connection, $id);
        }
    }

    static public function loadProductCategoryById(PDO $connection, $productCategoryId)
    {
        $sql = "SELECT * FROM products_category WHERE productCategoryId = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":id", $productCategoryId);
        $stmt->execute();
        while ($item = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $productCategory = new ProductCategory();
            $productCategory->setProductCategoryId($item['productCategoryId']);
            $productCategory->setProductCategoryName($item['productCategoryName']);
        }
        return $productCategory;
    }

    static public function loadAllProductCategories (PDO $connection)
    {
        $sql = "SELECT * FROM products_category";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $categoriesArray = [];
        while ($item = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $productCategory = new ProductCategory();
            $productCategory->setProductCategoryId($item['productCategoryId']);
            $productCategory->setProductCategoryName($item['productCategoryName']);
            $categoriesArray[] = $productCategory;
        }
        return $categoriesArray;
    }

    static public function removeProductCategory(PDO $connection, $productCategoryId)
    {
        $sql = "DELETE FROM products_category WHERE productCategoryId = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":id", $productCategoryId);
        $result = $stmt->execute();
        if (!$result) {
            throw new Exception("nie można usunąć kategorii");
        }
        return true;
    }


}

