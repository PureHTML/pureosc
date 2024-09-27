<?php

declare(strict_types=1);

/**
 * This file is part of the DvereCOM package
 *
 *  (c) Šimon Formánek <mail@simonformanek.cz>
 * This file is part of the MultiFlexi package
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class images_products_thumbs
{
    public $action = 'resize';
    public $function_name = 'tep_get_products_name';
    public $directory = 'products/thumbs/';
    public $origin_directory = 'products/originals/';
    public $title;

    public function __construct()
    {
        $this->title = MODULE_IMAGES_PRODUCTS_THUMBS_TITLE;
    }

    public function getOutput()
    {
        $output = [];

        $products_query = tep_db_query('select products_id, products_image from products');

        while ($products = tep_db_fetch_array($products_query)) {
            $output[$products['products_id']][] = $products['products_image'];

            $pi_query = tep_db_query("select image from products_images where products_id = '".(int) $products['products_id']."'");

            if (tep_db_num_rows($pi_query) > 0) {
                while ($pi = tep_db_fetch_array($pi_query)) {
                    $output[$products['products_id']][] = $pi['image'];
                }
            }
        }

        tep_db_free_result($products_query);

        return $output;
    }
}
