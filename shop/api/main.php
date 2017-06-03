<?php

function __autoload($className)

{
    include_once '../../src/' . $className . '.php';
}

session_start();

function serializeProdCat(ProductCategory $productCategory)
{
    return array(
        'id' => $productCategory->getProductCategoryId(),
        'name' => $productCategory->getProductCategoryName()
    );
}

function serializeProduct(Product $product, $conn)
{
    return array(
        'id' => $product->getProductId(),
        'price' => $product->getProductPrice(),
        'name' => $product->getProductName(),
        'description' => $product->getProductDescription(),
        'url' => ImageRepository::getImageLinksByProduct($conn, $product)
    );
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $conn = new Connection();
        $conn = $conn->doConnect();
        $productCategories = ProductCategoryRepository::loadAllProductCategories($conn);
        $last3Products = ProductRepository::loadLastThreeProducts($conn);
        $data = array('prodCat' => array(),
            'last3' => array());
        foreach ($productCategories as $productCategory) {
            $data['prodCat'][] = serializeProdCat($productCategory);
        }
        foreach ($last3Products as $product) {
            $data['last3'][] = serializeProduct($product, $conn);
        }
        $conn = null;
        echo json_encode($data);
    }
}
