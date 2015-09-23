<?php

/*
 * This file is part of a test.
 *
 * (c) Andre Reis <andre.reis@gmail.com>
 *
 */

namespace reis\Sains;

/**
 * This package parses an supermarket page looking for information about products.
 *
 * @package    Sains
 * @author     Andre Reis <andre.reis@gmail.com>
 * @copyright  Andre Reis <andre.reis@gmail.com>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://www.github.com/reis/sains
 */

class WebData
{

    public function getContent($url)
    {
        $ch  = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'sains.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'sains.txt');
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        //curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_STDERR,  fopen('php://stdout', 'w'));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        $page = curl_exec($ch);
        if(curl_errno($ch)){
            echo 'Curl error: ' . curl_error($ch);
        }
        curl_close($ch);

        return($page);
    }


    public function getSize($url)
    {
        $page = WebData::getContent($url);

        return(round(strlen($page) / 1024, 2).' KB' );
    }
}
?>