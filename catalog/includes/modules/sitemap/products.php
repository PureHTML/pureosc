<?php

declare(strict_types=1);

/**
 * PureOSC, Open Source E-Commerce Solutions
 * https://pureosc.com
 *
 * Copyright (c) 2024 PureOSC
 *
 * Released under the GNU General Public License
 *
 * This file is part of the PureOSC package
 *
 *  (c) 2024 Šimon Formánek <mail@simonformanek.cz>
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

foreach ($languages_array as $languages) {
    $sitemap_file = 'sitemap-products'.($languages['code'] === DEFAULT_LANGUAGE ? '' : '-'.$languages['code']).'.xml';

    $products_query = tep_db_query("SELECT DISTINCT p.*, pd.* FROM products p LEFT JOIN products_description pd ON p.products_id = pd.products_id WHERE p.products_status = '1' and language_id = '".(int) $languages['languages_id']."' ORDER BY p.products_last_modified DESC, p.products_date_added DESC");

    $fp = fopen($sitemap_file, 'wb');
    $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

    while ($products = tep_db_fetch_array($products_query)) {
        $xml .= "  <url>\n";
        $xml .= '    <loc>'.tep_href_link('product_info.php', 'products_id='.(int) $products['products_id'], 'SSL', false)."</loc>\n";
        $xml .= '    <lastmod>'.(strtotime($products['products_last_modified']) > strtotime($products['products_date_added']) ? date('Y-m-d', strtotime($products['products_last_modified'])) : date('Y-m-d', strtotime($products['products_date_added'])))."</lastmod>\n";
        $xml .= "    <changefreq>weekly</changefreq>\n";
        $xml .= "    <priority>0.5</priority>\n";
        $xml .= "  </url>\n";
    }

    $xml .= '</urlset>';

    tep_db_free_result($products_query);

    if (file_put_contents(DIR_FS_CATALOG.$sitemap_file, $xml) !== false) {
        $sitemap_array[] = $sitemap_file;
    }
}
