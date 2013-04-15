<?php

require_once dirname(__FILE__).'/../../../../../../bootstrap.php';

/**
 * Wishlist Item tests
 */
class Mage_Wishlist_Model_ItemTest extends Magento_PHPUnit_Integration_TestCase
{
    /**
     * Test for method: addToCart
     */
    public function testGetProductUrl()
    {
        $wishlist = new Mage_Wishlist_Model_Item();
        $product = new Mage_Catalog_Model_Product();
        $product->load(1);
        $wishlist->setProduct($product);
        $url = $wishlist->getProductUrl();
        $urlParts = parse_url($url);
        $this->assertEquals(
            $urlParts['path'] .
            ($urlParts['query'] ? '?'.$urlParts['query'] : '') .
            ($urlParts['fragment'] ? '#'.$urlParts['fragment'] : ''),
            '/phpunit/x1.html'
        );
    }
}
