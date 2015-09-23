<?php
/*
 * This file is part of the Money package.
 *
 * (c) Andre Reis <andre.reis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
include('src/ProductParser.class.php');

class ProductParserTest extends PHPUnit_Framework_TestCase
{
    public function testValidJSON()
    {
        $a = new reis\Sains\ProductParser("http://www.sainsburys.co.uk/webapp/wcs/stores/servlet/CategoryDisplay?listView=true&orderBy=FAVOURITES_FIRST&parent_category_rn=12518&top_category=12518&langId=44&beginIndex=0&pageSize=20&catalogId=10137&searchTerm=&categoryId=185749&listId=&storeId=10151&promotionId=#langId=44&storeId=10151&catalogId=10137&categoryId=185749&parent_category_rn=12518&top_category=12518&pageSize=20&orderBy=FAVOURITES_FIRST&searchTerm=&beginIndex=0&hideFilters=true");

        $data = json_decode($a->getProductsJSON(), true);
        $this->assertArrayHasKey('results', $data);
    }
}
