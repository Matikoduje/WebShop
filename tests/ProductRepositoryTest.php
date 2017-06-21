<?php




class ProductRepositoryTest extends AbstractDatabaseTest
{
    public function testSave()
    {
        $newProduct = new Product();
        $newProduct->setProductId(-1);
        $newProduct->setProductName("aaa");
        $newProduct->setProductPrice(11);
        $newProduct->setProductDescription("bbb");
        $newProduct->setProductCategory(22);
        $newProduct->setProductQuantity(33);

        $savedProduct = ProductRepository::save($this->pdo, $newProduct);
        $this->assertNotEquals(-1, $savedProduct->getProductId());
        $this->assertEquals("aaa", $savedProduct->setProductName());
        $this->assertEquals(11, $savedProduct->setProductPrice());
        $this->assertEquals("bbb", $savedProduct->getProductDescription());
        $this->assertEquals(22, $savedProduct->getProductCategory());
        $this->assertEquals(33, $savedProduct->getProductQuantity());

    }

    public function testModify()
    {
        $newProduct = new Product();
        $newProduct->setProductId(333);
        $newProduct->setProductName("xxx");
        $newProduct->setProductPrice(55);
        $newProduct->setProductDescription("zzz");
        $newProduct->setProductCategory(66);
        $newProduct->setProductQuantity(77);

        $savedProduct = ProductRepository::save($this->pdo, $newProduct);
        $this->assertEquals(333, $savedProduct->getProductId());
        $this->assertEquals("xxx", $savedProduct->setProductName());
        $this->assertEquals(55, $savedProduct->setProductPrice());
        $this->assertEquals("zzz", $savedProduct->getProductDescription());
        $this->assertEquals(66, $savedProduct->getProductCategory());
        $this->assertEquals(77, $savedProduct->getProductQuantity());

    }

    public function testLoadProductById()
    {
        $loadedProduct = ProductRepository::loadProductById($this->pdo,36);

        $this->assertEquals("kalarepa", $loadedProduct->getProductName());
        $this->assertEquals(2, $loadedProduct->getProductPrice());
        $this->assertEquals(24, $loadedProduct->getProductCategory());

    }

    public function testLoadAllProducts()
    {
        $productsArray = ProductRepository::loadAllProducts($this->pdo);

        $this->assertEquals(17, count($productsArray));

    }

    public function testSetCategoryForProduct()
    {
        $product = ProductRepository::loadProductById($this->pdo, 36);
        $oldCategory = $product->getProductCategory();
        ProductRepository::setCategoryForProduct($this->pdo, 36, 19);
        $modifiedProduct = ProductRepository::loadProductById($this->pdo,36);
        $this->assertTrue( $oldCategory != $modifiedProduct->getProductCategory());

    }

    public function testChangeInventory()
    {
        $product = ProductRepository::loadProductById($this->pdo, 8);
        $quantity = $product->getProductQuantity();
        ProductRepository::changeInventory($this->pdo, $product->getProductId(), 50);
        $modifiedProduct = ProductRepository::loadProductById($this->pdo, 8);
        $this->assertTrue($quantity + 50 == $modifiedProduct->getProductQuantity());

    }

    public function testRemoveProduct()
    {
        ProductRepository::removeProduct($this->pdo, 34);
        $this->assertNull(ProductRepository::loadProductById($this->pdo, 34));

    }

}