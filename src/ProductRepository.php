<?php

class ProductRepository
{
    static public function save(PDO $connection, Product $product)
    {
        $id = $product->getProductId();
        $name = $product->getProductName();
        $price = $product->getProductPrice();
        $description = $product->getProductDescription();
        $category = $product->getProductCategory();
        $quantity = $product->getProductQuantity();

        if ($id == -1) {
            $sql = "INSERT INTO products(productName, productPrice, productDescription, productCategory, productQuantity)
                    VALUES (:name, :price, :description, :category, :quantity)";
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":price", $price);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":category", $category);
            $stmt->bindParam(":quantity", $quantity);
            $stmt->execute();
            $productId = $connection->lastInsertId();
            $product = ProductRepository::loadProductById($connection, $productId);
            return $product;
        } elseif ($id != -1) {
            $sql = "UPDATE products SET productName = :name,
                                        productPrice = :price,
                                        productDescription = :description,
                                        productCategory = :category,
                                        productQuantity = :quantity
                    WHERE productId = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":price", $price);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":category", $category);
            $stmt->bindParam(":quantity", $quantity);
            $stmt->execute();
            $product = ProductRepository::loadProductById($connection, $id);
            return $product;
        }
    }

    static public function loadProductById(PDO $connection, $productId)
    {
        $sql = "SELECT * FROM products WHERE productId = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":id", $productId);
        $stmt->execute();
        while ($item = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product = new Product();
            $product->setProductId($item['productId']);
            $product->setProductName($item['productName']);
            $product->setProductPrice($item['productPrice']);
            $product->setProductDescription($item['productDescription']);
            $product->setProductCategory($item['productCategory']);
            $product->setProductQuantity($item['productQuantity']);
        }
        return $product;
    }

    static public function getProductInfo(PDO $connection, $productId, $info)
    {
        $sql = "SELECT " . $info . " FROM products WHERE productId = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":id", $productId);
        $stmt->execute();
        while ($item = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $info = $item[''. $info .''];
        }
        return $info;
    }

    static public function loadAllProducts(PDO $connection)
    {
        $sql = "SELECT * FROM products";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $productsArray = [];
        while ($item = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product = new Product();
            $product->setProductId($item['productId']);
            $product->setProductName($item['productName']);
            $product->setProductPrice($item['productPrice']);
            $product->setProductDescription($item['productDescription']);
            $product->setProductCategory($item['productCategory']);
            $product->setProductQuantity($item['productQuantity']);
            $productsArray[] = $product;
        }
        return $productsArray;
    }

    static public function setCategoryForProduct($connection, $productId, $productCategoryId)
    {
        $product = ProductRepository::loadProductById($connection, $productId);
        $product->setProductCategory($productCategoryId);
        ProductRepository::save($connection, $product);
    }

    static public function changeInventory(PDO $connection, $productId, $quantity)
    {
        $product = ProductRepository::loadProductById($connection, $productId);
        $currentInventory = $product->getProductQuantity();
        $newInventory = $currentInventory + $quantity;
        if ($newInventory >= 0 ) {
            $product->setProductQuantity($newInventory);
            $newProduct = ProductRepository::save($connection,$product);
            return $newProduct;
        } else {
            return null;
        }
    }

    static public function removeProduct(PDO $connection, $productId)
    {
        $sql = "DELETE FROM products WHERE productId = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":id", $productId);
        $result = $stmt->execute();
        return $result;
    }

    static public function saveImageForProduct(PDO $connection, $productId)
    {
        $fileName = $_FILES['imageFile']['name'];
        $path = '../images/' . $productId . '/';
        if (!file_exists($path)) {
            mkdir($path);
        }
        $path .= $fileName;
        $result = move_uploaded_file($_FILES['imageFile']['tmp_name'], $path);
        if ($result == true) {
            return true;
        } else {
            return false;
        };
    }

    static public function loadLastThreeProducts(PDO $connection)
    {
        $sql = 'SELECT * FROM (SELECT * FROM products ORDER BY productId DESC LIMIT 3) as p ORDER BY productId';
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $productsArray = [];
        while ($item = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product = new Product();
            $product->setProductId($item['productId']);
            $product->setProductName($item['productName']);
            $product->setProductPrice($item['productPrice']);
            $product->setProductDescription($item['productDescription']);
            $product->setProductCategory($item['productCategory']);
            $product->setProductQuantity($item['productQuantity']);
            $productsArray[] = $product;
        }
        return $productsArray;
    }

}