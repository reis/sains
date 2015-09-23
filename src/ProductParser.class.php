<?php

/*
 * This file is part of a test.
 *
 * (c) Andre Reis <andre.reis@gmail.com>
 *
 */
namespace reis\Sains;

include ('WebData.class.php');

/**
 * This package parses an supermarket page looking for information about products.
 *
 * @package    Sains
 * @author     Andre Reis <andre.reis@gmail.com>
 * @copyright  Andre Reis <andre.reis@gmail.com>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://www.github.com/reis/sains
 */

class ProductParser
{

    public $url;
    public $html;
    public $products;
    public $products_json;

    public function __construct($url)
    {
        $this->url = $url;
        $this->html = WebData::getContent($url);
        $this->products = $this->parseHtml();
        $this->products_json = json_encode($this->products);
    }

    public function parseHtml()
    {
        $lines = explode(PHP_EOL, $this->html);

        $products['results'] = array();
        $total = 0;

        for($i=0;$i < count($lines); $i++) {
            
            if(strpos($lines[$i], "<div class=\"productInfo\"") !== false) {
                $product = array();
                $product["title"] = trim($lines[$i+4]);
                $link = split('"', $lines[$i+3]);
                $product["size"] = WebData::getSize($link[1]);
                $product["description"] = trim($lines[$i+4]);
            }
            elseif(strpos($lines[$i], "<p class=\"pricePerUnit\">") !== false) {
                $unit_price = split("<",$lines[$i+1]);
                $unit_price = substr($unit_price[0], 1);
                $product["unit_price"] = $unit_price;
                $total += $unit_price;

                $products['results'][] = $product;
            }  
        }
        $products["total"] =  $total;

        return($products);
    }

    public function getProductsJson()
    {
        return($this->products_json);
    }
}

?>