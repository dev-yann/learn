<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 11/03/2018
 * Time: 15:31
 */
namespace test;
use PHPUnit\Framework\TestCase;
use hello\Product;
class TestProduct extends TestCase
{
    /**
     * Il faut reproduire l'arborescence de la classe que vous souhaitez tester
     */

    public function testcomputeTVAFoodProduct(){
        $product = new Product('Un produit', Product::FOOD_PRODUCT, 20);
        $this->assertSame(1.2, $product->computeTVA());
    }


}