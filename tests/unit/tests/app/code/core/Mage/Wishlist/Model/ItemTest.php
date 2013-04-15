<?php

require_once dirname(__FILE__).'/../../../../../../bootstrap.php';

/**
 * Wishlist Item tests
 */
class Mage_Wishlist_Model_ItemTest extends Magento_PHPUnit_TestCase
{
    /**
     * Wishlist Item mock object
     *
     * @var Mage_Wishlist_Model_Item
     */
    protected $_item = null;

    /**
     * Shopping Cart mock object
     *
     * @var Mage_Checkout_Model_Cart
     */
    protected $_cart = null;

    /**
     * Product for wishlist item mock object
     *
     * @var Mage_Catalog_Model_Product
     */
    protected $_product = null;

    public function setUp()
    {
        parent::setUp();
        // init product mock
        $this->_product = $this->getMock(
            Mage::getConfig()->getModelClassName('catalog/product'),
            array('getVisibleInSiteVisibilities', 'isSalable', 'getIdFieldName'), array(), '', false
        );
        $this->_product->setId(5)
            ->setStoreId(1)
            ->setStatus(Mage_Catalog_Model_Product_Status::STATUS_ENABLED);
        $this->_product->expects($this->any())
            ->method('getVisibleInSiteVisibilities')
            ->will($this->returnValue(array(3,2,4)));
        $this->_product->expects($this->any())
            ->method('isSalable')
            ->will($this->returnValue(true));
        $this->_product->expects($this->any())
            ->method('getIdFieldName')
            ->will($this->returnValue(false));

        // init item mock
        $this->_item = $this->getMock(
            Mage::getConfig()->getModelClassName('wishlist/item'),
            array('getId')
        );
        $this->_item->setProduct($this->_product)
            ->setStoreId(0);

        // init cart mock
        $quote = $this->getMock(Mage::getConfig()->getModelClassName('sales/quote'), array('getItemByProduct'));
        $quote->expects($this->any())
                 ->method('getItemByProduct')
                 ->will($this->returnValue(new Varien_Object()));

        $this->_cart = $this->getMock(Mage::getConfig()->getModelClassName('checkout/cart'), array('addProduct'));
        $this->_cart->setQuote($quote)
            ->expects($this->any())
            ->method('addProduct');

        // init catalog url resource
        $resourceUrl = $this->getResourceSingletonMockBuilder('catalog/url')
            ->setMethods(array('getRewriteByProductStore'))
            ->getMock();
        $resourceUrl->expects($this->any())
            ->method('getRewriteByProductStore')
            ->will($this->returnValue(array($this->_product->getId() => '', 'visibility' => 2)));
    }

    /**
     * Test for method: addToCart
     */
    public function testAddToCartAddProduct()
    {
        $this->_cart->expects($this->once())
                 ->method('addProduct');
        $this->_product->setMandatoryInstallation(true);
        $this->assertTrue($this->_item->addToCart($this->_cart));
    }

    /**
     * Test for method: addToCart
     */
    public function testAddToCartStatusEnabled()
    {
        $this->_product->setStatus(Mage_Catalog_Model_Product_Status::STATUS_DISABLED);
        $this->assertFalse($this->_item->addToCart($this->_cart), 'Try to add to cart disabled product.');

        $this->_product->setStatus(Mage_Catalog_Model_Product_Status::STATUS_ENABLED);
        $this->assertTrue($this->_item->addToCart($this->_cart), 'Try to add to cart disabled product.');
    }

    /**
     * Test for method: addToCart
     */
    public function testAddToCartNotVisibleInSiteVisibilityStore()
    {
        $this->_product->setStoreId(1);
        $this->assertTrue($this->_item->addToCart($this->_cart), 'Try to add to cart the product from other store.');

        $this->_product->setStoreId(0);
        $this->assertFalse($this->_item->addToCart($this->_cart), 'Try to add to cart the product from other store.');
    }

    /**
     * Test for method: addToCart
     */
    public function testAddToCartNotVisibleInSiteVisibilityUrlResource()
    {
        $resourceUrl = $this->getResourceSingletonMockBuilder('catalog/url')
            ->setMethods(array('getRewriteByProductStore'))
            ->getMock();
        $resourceUrl->expects($this->any())
            ->method('getRewriteByProductStore')
            ->will($this->returnValue(array($this->_product->getId() => '', 'visibility' => 2)));
        $this->assertTrue($this->_item->addToCart($this->_cart));

        $resourceUrl = $this->getResourceSingletonMockBuilder('catalog/url')
            ->setMethods(array('getRewriteByProductStore'))
            ->getMock();
        $resourceUrl->expects($this->any())
            ->method('getRewriteByProductStore')
            ->will($this->returnValue(array('visibility' => 2)));
        $this->assertFalse($this->_item->addToCart($this->_cart));
    }

    /**
     * Test for method: addToCart
     */
    public function testAddToCartNotVisibleInSiteVisibilityProductVisible()
    {
        $resourceUrl = $this->getResourceSingletonMockBuilder('catalog/url')
            ->setMethods(array('getRewriteByProductStore'))
            ->getMock();
        $resourceUrl->expects($this->any())
            ->method('getRewriteByProductStore')
            ->will($this->returnValue(array($this->_product->getId() => '', 'visibility' => 2)));
        $this->assertTrue($this->_item->addToCart($this->_cart));

        $resourceUrl = $this->getResourceSingletonMockBuilder('catalog/url')
            ->setMethods(array('getRewriteByProductStore'))
            ->getMock();
        $resourceUrl->expects($this->any())
            ->method('getRewriteByProductStore')
            ->will($this->returnValue(array($this->_product->getId() => '','visibility' => 6)));
        $this->assertFalse($this->_item->addToCart($this->_cart));
    }

    /**
     * Test for method: addToCart
     */
    public function testAddToCartNotSalableProduct()
    {
        $productSalable = $this->getMock(
            Mage::getConfig()->getModelClassName('catalog/product'),
            array('getVisibleInSiteVisibilities', 'isSalable', 'getIdFieldName'), array(), '', false
        );
        $productSalable->setId($this->_product->getId())
            ->setStoreId(1)
            ->setStatus(Mage_Catalog_Model_Product_Status::STATUS_ENABLED);
        $productSalable->expects($this->any())
            ->method('getVisibleInSiteVisibilities')
            ->will($this->returnValue(array(3,2,4)));
        $productSalable->expects($this->any())
            ->method('isSalable')
            ->will($this->returnValue(true));
        $productSalable->expects($this->any())
            ->method('getIdFieldName')
            ->will($this->returnValue(false));

        $productUnsalable = $this->getMock(
            Mage::getConfig()->getModelClassName('catalog/product'),
            array('getVisibleInSiteVisibilities', 'isSalable', 'getIdFieldName'), array(), '', false
        );
        $productUnsalable->setId($this->_product->getId())
            ->setStoreId(1)
            ->setStatus(Mage_Catalog_Model_Product_Status::STATUS_ENABLED);
        $productUnsalable->expects($this->any())
            ->method('getVisibleInSiteVisibilities')
            ->will($this->returnValue(array(3,2,4)));
        $productUnsalable->expects($this->any())
            ->method('isSalable')
            ->will($this->returnValue(false));
        $productUnsalable->expects($this->any())
            ->method('getIdFieldName')
            ->will($this->returnValue(false));

        try  {
            $this->_item->setProduct($productSalable);
            $this->assertTrue($this->_item->addToCart($this->_cart));
        } catch (Mage_Core_Exception $e) {
            if ($e->getCode() == Mage_Wishlist_Model_Item::EXCEPTION_CODE_NOT_SALABLE) {
                $this->fail('The product must be salable');
            } else {
                throw $e;
            }
        }

        $this->setExpectedException('Mage_Core_Exception', null, Mage_Wishlist_Model_Item::EXCEPTION_CODE_NOT_SALABLE);
        $this->_item->setProduct($productUnsalable);
        $this->_item->addToCart($this->_cart);
    }

    /**
     * Test for method: addToCart
     */
    public function testAddToCartUsingDeleteFlag()
    {
        $itemDelete = $this->getMock(Mage::getConfig()->getModelClassName('wishlist/item'), array('getId', 'delete'));
        $itemDelete->setProduct($this->_product)
            ->setStoreId(0)
            ->expects($this->once())
            ->method('delete');

        $itemDelete->addToCart($this->_cart, true);

        $itemNotDelete = $this->getMock(
            Mage::getConfig()->getModelClassName('wishlist/item'),
            array('getId', 'delete')
        );
        $itemNotDelete->setProduct($this->_product)
            ->setStoreId(0)
            ->expects($this->never())
            ->method('delete');

        $itemNotDelete->addToCart($this->_cart, false);
    }
}
