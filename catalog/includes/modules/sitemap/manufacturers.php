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

$sitemap_file = 'sitemap-manufacturers.xml';

$manufacturers_query = tep_db_query('SELECT m.* FROM manufacturers m ORDER BY m.last_modified DESC, m.date_added DESC');

if (tep_db_num_rows($manufacturers_query) > 0) {
    $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

    while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
        $xml .= "  <url>\n";
        $xml .= '    <loc>'.tep_href_link('manufacturers.php', 'manufacturer_id='.(int) $manufacturers['manufacturers_id'], 'SSL', false)."</loc>\n";
        $xml .= '    <lastmod>'.(strtotime($manufacturers['last_modified']) > strtotime($manufacturers['date_added']) ? date('Y-m-d', strtotime($manufacturers['last_modified'])) : date('Y-m-d', strtotime($manufacturers['date_added'])))."</lastmod>\n";
        $xml .= "    <changefreq>weekly</changefreq>\n";
        $xml .= "    <priority>0.5</priority>\n";
        $xml .= "  </url>\n";
    }

    $xml .= '  </urlset>';

    tep_db_free_result($manufacturers_query);

    if (file_put_contents(DIR_FS_CATALOG.$sitemap_file, $xml) !== false) {
        $sitemap_array[] = $sitemap_file;
    }
}
