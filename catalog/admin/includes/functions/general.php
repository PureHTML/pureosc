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

// //
// Get the installed version number
function tep_get_version()
{
    static $v;

    if (!isset($v)) {
        $v = trim(implode('', file(DIR_FS_CATALOG.'includes/version.php')));
    }

    return $v;
}

// //
// Redirect to another page or site
function tep_redirect($url): void
{
    global $logger;

    if ((strstr($url, "\n") !== false) || (strstr($url, "\r") !== false)) {
        tep_redirect(tep_href_link('index.php', '', 'SSL', false));
    }

    if (strpos($url, '&amp;') !== false) {
        $url = str_replace('&amp;', '&', $url);
    }

    header('Location: '.$url);

    if (STORE_PAGE_PARSE_TIME === 'true') {
        if (!\is_object($logger)) {
            $logger = new logger();
        }

        $logger->timer_stop();
    }

    exit;
}

// //
// Parse the data used in the html tags to ensure the tags will not break
function tep_parse_input_field_data($data, $parse)
{
    //    return strtr(trim($data), $parse);
    return $data; // TODO: dirtyHack!
}

function tep_output_string($string, $translate = false, $protected = false)
{
    if ($protected === true) {
        return htmlspecialchars($string);
    }

    if ($translate === false) {
        return tep_parse_input_field_data($string, ['"' => '&quot;']);
    }

    return tep_parse_input_field_data($string, $translate);
}

function tep_output_string_protected($string)
{
    return tep_output_string($string, false, true);
}

function tep_sanitize_string($string)
{
    $patterns = ['/ +/', '/[<>]/'];
    $replace = [' ', '_'];

    return preg_replace($patterns, $replace, trim($string));
}

function tep_customers_name($customers_id)
{
    $customers = tep_db_query("select customers_firstname, customers_lastname from customers where customers_id = '".(int) $customers_id."'");
    $customers_values = tep_db_fetch_array($customers);

    return $customers_values['customers_firstname'].' '.$customers_values['customers_lastname'];
}

function tep_get_path($current_category_id = '')
{
    global $cPath_array;

    if ($current_category_id === '') {
        if (!isset($cPath_array) || (\count($cPath_array) === 0)) {
            $cPath_new = '';
        } else {
            $cPath_new = implode('_', $cPath_array);
        }
    } else {
        if (!isset($cPath_array) || (\count($cPath_array) === 0)) {
            $cPath_new = $current_category_id;
        } else {
            $cPath_new = '';
            $last_category_query = tep_db_query("select parent_id from categories where categories_id = '".(int) $cPath_array[\count($cPath_array) - 1]."'");
            $last_category = tep_db_fetch_array($last_category_query);

            $current_category_query = tep_db_query("select parent_id from categories where categories_id = '".(int) $current_category_id."'");
            $current_category = tep_db_fetch_array($current_category_query);

            if ($last_category['parent_id'] === $current_category['parent_id']) {
                for ($i = 0, $n = \count($cPath_array) - 1; $i < $n; ++$i) {
                    $cPath_new .= '_'.$cPath_array[$i];
                }
            } else {
                for ($i = 0, $n = \count($cPath_array); $i < $n; ++$i) {
                    $cPath_new .= '_'.$cPath_array[$i];
                }
            }

            $cPath_new .= '_'.$current_category_id;

            if (substr($cPath_new, 0, 1) === '_') {
                $cPath_new = substr($cPath_new, 1);
            }
        }
    }

    return 'cPath='.$cPath_new;
}

function tep_get_all_get_params($exclude_array = '')
{
    if (!\is_array($exclude_array)) {
        $exclude_array = [];
    }

    $exclude_array[] = session_name();
    $exclude_array[] = 'error';

    $get_url = '';

    if (\is_array($_GET) && (!empty($_GET))) {
        foreach ($_GET as $key => $value) {
            if (!\in_array($key, $exclude_array, true)) {
                $get_url .= $key.'='.rawurlencode(stripslashes($value)).'&';
            }
        }
    }

    return $get_url;
}

function tep_date_long($raw_date)
{
    if (($raw_date === '0000-00-00 00:00:00') || ($raw_date === '')) {
        return false;
    }

    $year = (int) substr($raw_date, 0, 4);
    $month = (int) substr($raw_date, 5, 2);
    $day = (int) substr($raw_date, 8, 2);
    $hour = (int) substr($raw_date, 11, 2);
    $minute = (int) substr($raw_date, 14, 2);
    $second = (int) substr($raw_date, 17, 2);

    return strftime(DATE_FORMAT_LONG, mktime($hour, $minute, $second, $month, $day, $year));
}

// //
// Output a raw date string in the selected locale date format
// $raw_date needs to be in this format: YYYY-MM-DD HH:MM:SS
// NOTE: Includes a workaround for dates before 01/01/1970 that fail on windows servers
function tep_date_short($raw_date)
{
    if (($raw_date === '0000-00-00 00:00:00') || ($raw_date === '')) {
        return false;
    }

    $year = (int) substr($raw_date, 0, 4);
    $month = (int) substr($raw_date, 5, 2);
    $day = (int) substr($raw_date, 8, 2);
    $hour = (int) substr($raw_date, 11, 2);
    $minute = (int) substr($raw_date, 14, 2);
    $second = (int) substr($raw_date, 17, 2);

    if (@date('Y', mktime($hour, $minute, $second, $month, $day, $year)) === $year) {
        return date(DATE_FORMAT, mktime($hour, $minute, $second, $month, $day, $year));
    }

    return date(DATE_FORMAT, mktime($hour, $minute, $second, $month, $day, 2037));
    // TODO    return preg_replace('/2037$/', $year, date(DATE_FORMAT, mktime($hour, $minute, $second, $month, $day, 2037)));
}

function tep_datetime_short($raw_datetime)
{
    if (($raw_datetime === '0000-00-00 00:00:00') || ($raw_datetime === '')) {
        return false;
    }

    $year = (int) substr($raw_datetime, 0, 4);
    $month = (int) substr($raw_datetime, 5, 2);
    $day = (int) substr($raw_datetime, 8, 2);
    $hour = (int) substr($raw_datetime, 11, 2);
    $minute = (int) substr($raw_datetime, 14, 2);
    $second = (int) substr($raw_datetime, 17, 2);

    return strftime(DATE_TIME_FORMAT, mktime($hour, $minute, $second, $month, $day, $year));
}

function tep_get_category_tree($parent_id = '0', $spacing = '', $exclude = '', $category_tree_array = '', $include_itself = false)
{
    global $languages_id;

    if (!\is_array($category_tree_array)) {
        $category_tree_array = [];
    }

    if ((\count($category_tree_array) < 1) && ($exclude !== '0')) {
        $category_tree_array[] = ['id' => '0', 'text' => TEXT_TOP];
    }

    if ($include_itself) {
        $category_query = tep_db_query("select cd.categories_name from categories_description cd where cd.language_id = '".(int) $languages_id."' and cd.categories_id = '".(int) $parent_id."'");

        if (tep_db_num_rows($category_query)) {
            $category = tep_db_fetch_array($category_query);

            $category_tree_array[] = ['id' => $parent_id, 'text' => $category['categories_name']];
        }
    }

    $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.parent_id from categories c, categories_description cd where c.categories_id = cd.categories_id and cd.language_id = '".(int) $languages_id."' and c.parent_id = '".(int) $parent_id."' order by c.sort_order, cd.categories_name");

    while ($categories = tep_db_fetch_array($categories_query)) {
        if ($exclude !== $categories['categories_id']) {
            $category_tree_array[] = ['id' => $categories['categories_id'], 'text' => $spacing.$categories['categories_name']];
        }

        $category_tree_array = tep_get_category_tree($categories['categories_id'], $spacing.'&nbsp;&nbsp;&nbsp;', $exclude, $category_tree_array);
    }

    return $category_tree_array;
}

function tep_draw_products_pull_down($name, $parameters = '', $exclude = '')
{
    global $currencies, $languages_id;

    if ($exclude === '') {
        $exclude = [];
    }

    $select_string = '<select name="'.$name.'"';

    if ($parameters) {
        $select_string .= ' '.$parameters;
    }

    $select_string .= '>';

    $products_query = tep_db_query("select p.products_id, pd.products_name, p.products_price from products p, products_description pd where p.products_id = pd.products_id and pd.language_id = '".(int) $languages_id."' order by products_name");

    while ($products = tep_db_fetch_array($products_query)) {
        if (!\in_array($products['products_id'], $exclude, true)) {
            $select_string .= '<option value="'.$products['products_id'].'">'.$products['products_name'].' ('.$currencies->format($products['products_price']).')</option>';
        }
    }

    $select_string .= '</select>';

    return $select_string;
}

function tep_format_system_info_array($array)
{
    $output = '';

    foreach ($array as $section => $child) {
        $output .= '['.$section."]\n";

        foreach ($child as $variable => $value) {
            if (\is_array($value)) {
                $output .= $variable.' = '.implode(',', $value)."\n";
            } else {
                $output .= $variable.' = '.$value."\n";
            }
        }

        $output .= "\n";
    }

    return $output;
}

function tep_options_name($options_id)
{
    global $languages_id;

    $options = tep_db_query("select products_options_name from products_options where products_options_id = '".(int) $options_id."' and language_id = '".(int) $languages_id."'");
    $options_values = tep_db_fetch_array($options);

    return $options_values['products_options_name'];
}

function tep_values_name($values_id)
{
    global $languages_id;

    $values = tep_db_query("select products_options_values_name from products_options_values where products_options_values_id = '".(int) $values_id."' and language_id = '".(int) $languages_id."'");
    $values_values = tep_db_fetch_array($values);

    return $values_values['products_options_values_name'];
}

function tep_info_image($image, $alt = '', $width = '', $height = '')
{
    global $request_type;

    if (!empty($image) && file_exists(DIR_FS_CATALOG.'images/'.$image)) {
        $image = tep_image(($request_type === 'SSL' ? HTTPS_SERVER : HTTP_SERVER).DIR_WS_CATALOG.'images/'.$image, $alt, $width, $height);
    } else {
        $image = TEXT_IMAGE_NONEXISTENT;
    }

    return $image;
}

function tep_break_string($string, $len, $break_char = '-')
{
    $l = 0;
    $output = '';

    for ($i = 0, $n = \strlen($string); $i < $n; ++$i) {
        $char = substr($string, $i, 1);

        if ($char !== ' ') {
            ++$l;
        } else {
            $l = 0;
        }

        if ($l > $len) {
            $l = 1;
            $output .= $break_char;
        }

        $output .= $char;
    }

    return $output;
}

function tep_get_country_name($country_id)
{
    $country_query = tep_db_query("select countries_name from countries where countries_id = '".(int) $country_id."'");

    if (!tep_db_num_rows($country_query)) {
        return $country_id;
    }

    $country = tep_db_fetch_array($country_query);

    return $country['countries_name'];
}

function tep_get_zone_name($country_id, $zone_id, $default_zone)
{
    $zone_query = tep_db_query("select zone_name from zones where zone_country_id = '".(int) $country_id."' and zone_id = '".(int) $zone_id."'");

    if (tep_db_num_rows($zone_query)) {
        $zone = tep_db_fetch_array($zone_query);

        return $zone['zone_name'];
    }

    return $default_zone;
}

function tep_not_null($value)
{
    if (\is_array($value)) {
        if (\count($value) > 0) {
            return true;
        }

        return false;
    }

    if ((\is_string($value) || \is_int($value)) && ($value !== '') && ($value !== 'NULL') && (trim($value) !== '')) {
        return true;
    }

    return false;
}

function tep_browser_detect($component)
{
    return stristr(getenv('HTTP_USER_AGENT'), $component);
}

function tep_tax_classes_pull_down($parameters, $selected = '')
{
    $select_string = '<select '.$parameters.'>';
    $classes_query = tep_db_query('SELECT tax_class_id, tax_class_title FROM tax_class ORDER BY tax_class_title');

    while ($classes = tep_db_fetch_array($classes_query)) {
        $select_string .= '<option value="'.$classes['tax_class_id'].'"';

        if ($selected === $classes['tax_class_id']) {
            $select_string .= ' SELECTED';
        }

        $select_string .= '>'.$classes['tax_class_title'].'</option>';
    }

    $select_string .= '</select>';

    return $select_string;
}

function tep_geo_zones_pull_down($parameters, $selected = '')
{
    $select_string = '<select '.$parameters.'>';
    $zones_query = tep_db_query('SELECT geo_zone_id, geo_zone_name FROM geo_zones ORDER BY geo_zone_name');

    while ($zones = tep_db_fetch_array($zones_query)) {
        $select_string .= '<option value="'.$zones['geo_zone_id'].'"';

        if ($selected === $zones['geo_zone_id']) {
            $select_string .= ' SELECTED';
        }

        $select_string .= '>'.$zones['geo_zone_name'].'</option>';
    }

    $select_string .= '</select>';

    return $select_string;
}

function tep_get_geo_zone_name($geo_zone_id)
{
    $zones_query = tep_db_query("select geo_zone_name from geo_zones where geo_zone_id = '".(int) $geo_zone_id."'");

    if (!tep_db_num_rows($zones_query)) {
        $geo_zone_name = $geo_zone_id;
    } else {
        $zones = tep_db_fetch_array($zones_query);
        $geo_zone_name = $zones['geo_zone_name'];
    }

    return $geo_zone_name;
}

function tep_address_format($address_format_id, $address, $html, $boln, $eoln)
{
    $address_format_query = tep_db_query("select address_format as format from address_format where address_format_id = '".(int) $address_format_id."'");
    $address_format = tep_db_fetch_array($address_format_query);

    $company = tep_output_string_protected($address['company']);

    if (isset($address['firstname']) && !empty($address['firstname'])) {
        $firstname = tep_output_string_protected($address['firstname']);
        $lastname = tep_output_string_protected($address['lastname']);
    } elseif (isset($address['name']) && !empty($address['name'])) {
        $firstname = tep_output_string_protected($address['name']);
        $lastname = '';
    } else {
        $firstname = '';
        $lastname = '';
    }

    $street = tep_output_string_protected($address['street_address']);
    $suburb = tep_output_string_protected($address['suburb']);
    $city = tep_output_string_protected($address['city']);
    $state = tep_output_string_protected($address['state']);

    if (isset($address['country_id']) && !empty($address['country_id'])) {
        $country = tep_get_country_name($address['country_id']);

        if (isset($address['zone_id']) && !empty($address['zone_id'])) {
            $state = tep_get_zone_code($address['country_id'], $address['zone_id'], $state);
        }
    } elseif (isset($address['country']) && !empty($address['country'])) {
        $country = tep_output_string_protected($address['country']);
    } else {
        $country = '';
    }

    $postcode = tep_output_string_protected($address['postcode']);
    $zip = $postcode;

    if ($html) {
        // HTML Mode
        $HR = '<hr />';
        $hr = '<hr />';

        if (($boln === '') && ($eoln === "\n")) { // Values not specified, use rational defaults
            $CR = '<br />';
            $cr = '<br />';
            $eoln = $cr;
        } else { // Use values supplied
            $CR = $eoln.$boln;
            $cr = $CR;
        }
    } else {
        // Text Mode
        $CR = $eoln;
        $cr = $CR;
        $HR = '----------------------------------------';
        $hr = '----------------------------------------';
    }

    $statecomma = '';
    $streets = $street;

    if ($suburb !== '') {
        $streets = $street.$cr.$suburb;
    }

    if ($country === '') {
        $country = tep_output_string_protected($address['country']);
    }

    if ($state !== '') {
        $statecomma = $state.', ';
    }

    $fmt = $address_format['format'];
    eval("\$address = \"{$fmt}\";");

    if ((ACCOUNT_COMPANY === 'true') && (!empty($company))) {
        $address = $company.$cr.$address;
    }

    return $address;
}

// //////////////////////////////////////////////////////////////////////////////////////////////
//
// Function    : tep_get_zone_code
//
// Arguments   : country           country code string
//               zone              state/province zone_id
//               def_state         default string if zone==0
//
// Return      : state_prov_code   state/province code
//
// Description : Function to retrieve the state/province code (as in FL for Florida etc)
//
// //////////////////////////////////////////////////////////////////////////////////////////////
function tep_get_zone_code($country, $zone, $def_state)
{
    $state_prov_query = tep_db_query("select zone_code from zones where zone_country_id = '".(int) $country."' and zone_id = '".(int) $zone."'");

    if (!tep_db_num_rows($state_prov_query)) {
        $state_prov_code = $def_state;
    } else {
        $state_prov_values = tep_db_fetch_array($state_prov_query);
        $state_prov_code = $state_prov_values['zone_code'];
    }

    return $state_prov_code;
}

function tep_get_uprid($prid, $params)
{
    $uprid = $prid;

    if (\is_array($params) && (!strstr($prid, '{'))) {
        foreach ($params as $option => $value) {
            $uprid = $uprid.'{'.$option.'}'.$value;
        }
    }

    return $uprid;
}

function tep_get_prid($uprid)
{
    $pieces = explode('{', $uprid);

    return $pieces[0];
}

function tep_get_languages()
{
    $languages_array = [];

    $languages_query = tep_db_query('SELECT languages_id, name, code, image, directory FROM languages ORDER BY sort_order');

    while ($languages = tep_db_fetch_array($languages_query)) {
        $languages_array[] = ['id' => $languages['languages_id'],
            'name' => $languages['name'],
            'code' => $languages['code'],
            'image' => $languages['image'],
            'directory' => $languages['directory']];
    }

    return $languages_array;
}

function tep_get_category_name($category_id, $language_id)
{
    $category_query = tep_db_query("select categories_name from categories_description where categories_id = '".(int) $category_id."' and language_id = '".(int) $language_id."'");
    $category = tep_db_fetch_array($category_query);

    return $category['categories_name'];
}

function tep_get_orders_status_name($orders_status_id, $language_id = '')
{
    global $languages_id;

    if (!$language_id) {
        $language_id = $languages_id;
    }

    $orders_status_query = tep_db_query("select orders_status_name from orders_status where orders_status_id = '".(int) $orders_status_id."' and language_id = '".(int) $language_id."'");
    $orders_status = tep_db_fetch_array($orders_status_query);

    return $orders_status['orders_status_name'];
}

function tep_get_orders_status()
{
    global $languages_id;

    $orders_status_array = [];
    $orders_status_query = tep_db_query("select orders_status_id, orders_status_name from orders_status where language_id = '".(int) $languages_id."' order by orders_status_id");

    while ($orders_status = tep_db_fetch_array($orders_status_query)) {
        $orders_status_array[] = ['id' => $orders_status['orders_status_id'],
            'text' => $orders_status['orders_status_name']];
    }

    return $orders_status_array;
}

function tep_get_products_name($product_id, $language_id = 0)
{
    global $languages_id;

    if ($language_id === 0) {
        $language_id = $languages_id;
    }

    $product_query = tep_db_query("select products_name from products_description where products_id = '".(int) $product_id."' and language_id = '".(int) $language_id."'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_name'];
}

function tep_get_products_description($product_id, $language_id)
{
    $product_query = tep_db_query("select products_description from products_description where products_id = '".(int) $product_id."' and language_id = '".(int) $language_id."'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_description'];
}

function tep_get_products_url($product_id, $language_id)
{
    $product_query = tep_db_query("select products_url from products_description where products_id = '".(int) $product_id."' and language_id = '".(int) $language_id."'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_url'];
}

// //
// Return the manufacturers URL in the needed language
// TABLES: manufacturers_info
function tep_get_manufacturer_url($manufacturer_id, $language_id)
{
    $manufacturer_query = tep_db_query("select manufacturers_url from manufacturers_info where manufacturers_id = '".(int) $manufacturer_id."' and languages_id = '".(int) $language_id."'");
    $manufacturer = tep_db_fetch_array($manufacturer_query);

    return $manufacturer['manufacturers_url'];
}

// //
// Wrapper for class_exists() function
function tep_class_exists($class_name)
{
    return class_exists($class_name);
}

// //
// Count how many products exist in a category
// TABLES: products, products_to_categories, categories
function tep_products_in_category_count($categories_id, $include_deactivated = false)
{
    $products_count = 0;

    if ($include_deactivated) {
        $products_query = tep_db_query("select count(*) as total from products p, products_to_categories p2c where p.products_id = p2c.products_id and p2c.categories_id = '".(int) $categories_id."'");
    } else {
        $products_query = tep_db_query("select count(*) as total from products p, products_to_categories p2c where p.products_id = p2c.products_id and p.products_status = '1' and p2c.categories_id = '".(int) $categories_id."'");
    }

    $products = tep_db_fetch_array($products_query);

    $products_count += $products['total'];

    $childs_query = tep_db_query("select categories_id from categories where parent_id = '".(int) $categories_id."'");

    if (tep_db_num_rows($childs_query)) {
        while ($childs = tep_db_fetch_array($childs_query)) {
            $products_count += tep_products_in_category_count($childs['categories_id'], $include_deactivated);
        }
    }

    return $products_count;
}

// //
// Count how many subcategories exist in a category
// TABLES: categories
function tep_childs_in_category_count($categories_id)
{
    $categories_count = 0;

    $categories_query = tep_db_query("select categories_id from categories where parent_id = '".(int) $categories_id."'");

    while ($categories = tep_db_fetch_array($categories_query)) {
        ++$categories_count;
        $categories_count += tep_childs_in_category_count($categories['categories_id']);
    }

    return $categories_count;
}

// //
// Returns an array with countries
// TABLES: countries
function tep_get_countries($default = '')
{
    $countries_array = [];

    if ($default) {
        $countries_array[] = ['id' => '',
            'text' => $default];
    }

    $countries_query = tep_db_query('SELECT countries_id, countries_name FROM countries ORDER BY countries_name');

    while ($countries = tep_db_fetch_array($countries_query)) {
        $countries_array[] = ['id' => $countries['countries_id'],
            'text' => $countries['countries_name']];
    }

    return $countries_array;
}

// //
// return an array with country zones
function tep_get_country_zones($country_id)
{
    $zones_array = [];
    $zones_query = tep_db_query("select zone_id, zone_name from zones where zone_country_id = '".(int) $country_id."' order by zone_name");

    while ($zones = tep_db_fetch_array($zones_query)) {
        $zones_array[] = ['id' => $zones['zone_id'],
            'text' => $zones['zone_name']];
    }

    return $zones_array;
}

function tep_prepare_country_zones_pull_down($country_id = '')
{
    // preset the width of the drop-down for Netscape
    $pre = '';

    if ((!tep_browser_detect('MSIE')) && tep_browser_detect('Mozilla/4')) {
        for ($i = 0; $i < 45; ++$i) {
            $pre .= '&nbsp;';
        }
    }

    $zones = tep_get_country_zones($country_id);

    if (\count($zones) > 0) {
        $zones_select = [['id' => '', 'text' => PLEASE_SELECT]];
        $zones = array_merge($zones_select, $zones);
    } else {
        $zones = [['id' => '', 'text' => TYPE_BELOW]];

        // create dummy options for Netscape to preset the height of the drop-down
        if ((!tep_browser_detect('MSIE')) && tep_browser_detect('Mozilla/4')) {
            for ($i = 0; $i < 9; ++$i) {
                $zones[] = ['id' => '', 'text' => $pre];
            }
        }
    }

    return $zones;
}

// //
// Get list of address_format_id's
function tep_get_address_formats()
{
    $address_format_query = tep_db_query('SELECT address_format_id FROM address_format ORDER BY address_format_id');
    $address_format_array = [];

    while ($address_format_values = tep_db_fetch_array($address_format_query)) {
        $address_format_array[] = ['id' => $address_format_values['address_format_id'],
            'text' => $address_format_values['address_format_id']];
    }

    return $address_format_array;
}

// //
// Alias function for Store configuration values in the Administration Tool
function tep_cfg_pull_down_country_list($country_id)
{
    return tep_draw_pull_down_menu('configuration_value', tep_get_countries(), $country_id);
}

function tep_cfg_pull_down_zone_list($zone_id)
{
    return tep_draw_pull_down_menu('configuration_value', tep_get_country_zones(STORE_COUNTRY), $zone_id);
}

function tep_cfg_pull_down_tax_classes($tax_class_id, $key = '')
{
    $name = (($key) ? 'configuration['.$key.']' : 'configuration_value');

    $tax_class_array = [['id' => '0', 'text' => TEXT_NONE]];
    $tax_class_query = tep_db_query('SELECT tax_class_id, tax_class_title FROM tax_class ORDER BY tax_class_title');

    while ($tax_class = tep_db_fetch_array($tax_class_query)) {
        $tax_class_array[] = ['id' => $tax_class['tax_class_id'],
            'text' => $tax_class['tax_class_title']];
    }

    return tep_draw_pull_down_menu($name, $tax_class_array, $tax_class_id);
}

// //
// Function to read in text area in admin
function tep_cfg_textarea($text)
{
    return tep_draw_textarea_field('configuration_value', false, 35, 5, $text);
}

function tep_cfg_get_zone_name($zone_id)
{
    $zone_query = tep_db_query("select zone_name from zones where zone_id = '".(int) $zone_id."'");

    if (!tep_db_num_rows($zone_query)) {
        return $zone_id;
    }

    $zone = tep_db_fetch_array($zone_query);

    return $zone['zone_name'];
}

// //
// Sets the status of a product
function tep_set_product_status($products_id, $status)
{
    if ($status === '1') {
        return tep_db_query("update products set products_status = '1', products_last_modified = now() where products_id = '".(int) $products_id."'");
    }

    if ($status === '0') {
        return tep_db_query("update products set products_status = '0', products_last_modified = now() where products_id = '".(int) $products_id."'");
    }

    return -1;
}

// //
// Sets the status of a review
function tep_set_review_status($reviews_id, $status)
{
    if ($status === '1') {
        return tep_db_query("update reviews set reviews_status = '1', last_modified = now() where reviews_id = '".(int) $reviews_id."'");
    }

    if ($status === '0') {
        return tep_db_query("update reviews set reviews_status = '0', last_modified = now() where reviews_id = '".(int) $reviews_id."'");
    }

    return -1;
}

// //
// Sets the status of a product on special
function tep_set_specials_status($specials_id, $status)
{
    if ($status === '1') {
        return tep_db_query("update specials set status = '1', expires_date = NULL, date_status_change = NULL where specials_id = '".(int) $specials_id."'");
    }

    if ($status === '0') {
        return tep_db_query("update specials set status = '0', date_status_change = now() where specials_id = '".(int) $specials_id."'");
    }

    return -1;
}

// //
// Sets timeout for the current script.
// Cant be used in safe mode.
function tep_set_time_limit($limit): void
{
    set_time_limit($limit);
}

// //
// Alias function for Store configuration values in the Administration Tool
function tep_cfg_select_option($select_array, $key_value, $key = '')
{
    $string = '';

    for ($i = 0, $n = \count($select_array); $i < $n; ++$i) {
        $name = ((!empty($key)) ? 'configuration['.$key.']' : 'configuration_value');

        $string .= '<br /><input type="radio" name="'.$name.'" value="'.$select_array[$i].'"';

        if ($key_value === $select_array[$i]) {
            $string .= ' checked="checked"';
        }

        $string .= ' /> '.$select_array[$i];
    }

    return $string;
}

// //
// Alias function for module configuration keys
function tep_mod_select_option($select_array, $key_name, $key_value)
{
    foreach ($select_array as $key => $value) {
        if (\is_int($key)) {
            $key = $value;
        }

        $string .= '<br /><input type="radio" name="configuration['.$key_name.']" value="'.$key.'"';

        if ($key_value === $key) {
            $string .= ' checked="checked"';
        }

        $string .= ' /> '.$value;
    }

    return $string;
}

// //
// Retreive server information
function tep_get_system_information()
{
    $db_query = tep_db_query('select now() as datetime');
    $db = tep_db_fetch_array($db_query);

    @[$system, $host, $kernel] = preg_split('/[\s,]+/', @exec('uname -a'), 5);

    $data = [];

    $data['oscommerce'] = ['version' => tep_get_version()];

    $data['system'] = ['date' => date('Y-m-d H:i:s O T'),
        'os' => \PHP_OS,
        'kernel' => $kernel,
        'uptime' => @exec('uptime'),
        'http_server' => $_SERVER['SERVER_SOFTWARE']];

    $data['mysql'] = ['version' => tep_db_get_server_info(),
        'date' => $db['datetime']];

    $data['php'] = ['version' => \PHP_VERSION,
        'zend' => zend_version(),
        'sapi' => \PHP_SAPI,
        'int_size' => \defined('PHP_INT_SIZE') ? \PHP_INT_SIZE : '',
        'open_basedir' => (int) @\ini_get('open_basedir'),
        'memory_limit' => @\ini_get('memory_limit'),
        'error_reporting' => error_reporting(),
        'display_errors' => (int) @\ini_get('display_errors'),
        'allow_url_fopen' => (int) @\ini_get('allow_url_fopen'),
        'allow_url_include' => (int) @\ini_get('allow_url_include'),
        'file_uploads' => (int) @\ini_get('file_uploads'),
        'upload_max_filesize' => @\ini_get('upload_max_filesize'),
        'post_max_size' => @\ini_get('post_max_size'),
        'disable_functions' => @\ini_get('disable_functions'),
        'disable_classes' => @\ini_get('disable_classes'),
        'enable_dl' => (int) @\ini_get('enable_dl'),
        'filter.default' => @\ini_get('filter.default'),
        'zend.ze1_compatibility_mode' => (int) @\ini_get('zend.ze1_compatibility_mode'),
        'unicode.semantics' => (int) @\ini_get('unicode.semantics'),
        'zend_thread_safty' => (int) \function_exists('zend_thread_id'),
        'extensions' => get_loaded_extensions()];

    return $data;
}

function tep_generate_category_path($id, $from = 'category', $categories_array = '', $index = 0)
{
    global $languages_id;

    if (!\is_array($categories_array)) {
        $categories_array = [];
    }

    if ($from === 'product') {
        $categories_query = tep_db_query("select categories_id from products_to_categories where products_id = '".(int) $id."'");

        while ($categories = tep_db_fetch_array($categories_query)) {
            if ($categories['categories_id'] === '0') {
                $categories_array[$index][] = ['id' => '0', 'text' => TEXT_TOP];
            } else {
                $category_query = tep_db_query("select cd.categories_name, c.parent_id from categories c, categories_description cd where c.categories_id = '".(int) $categories['categories_id']."' and c.categories_id = cd.categories_id and cd.language_id = '".(int) $languages_id."'");
                $category = tep_db_fetch_array($category_query);
                $categories_array[$index][] = ['id' => $categories['categories_id'], 'text' => $category['categories_name']];

                if ((!empty($category['parent_id'])) && ($category['parent_id'] !== '0')) {
                    $categories_array = tep_generate_category_path($category['parent_id'], 'category', $categories_array, $index);
                }

                $categories_array[$index] = array_reverse($categories_array[$index]);
            }

            ++$index;
        }
    } elseif ($from === 'category') {
        $category_query = tep_db_query("select cd.categories_name, c.parent_id from categories c, categories_description cd where c.categories_id = '".(int) $id."' and c.categories_id = cd.categories_id and cd.language_id = '".(int) $languages_id."'");
        $category = tep_db_fetch_array($category_query);
        $categories_array[$index][] = ['id' => $id, 'text' => $category['categories_name']];

        if ((!empty($category['parent_id'])) && ($category['parent_id'] !== '0')) {
            $categories_array = tep_generate_category_path($category['parent_id'], 'category', $categories_array, $index);
        }
    }

    return $categories_array;
}

function tep_output_generated_category_path($id, $from = 'category')
{
    $calculated_category_path_string = '';
    $calculated_category_path = tep_generate_category_path($id, $from);

    for ($i = 0, $n = \count($calculated_category_path); $i < $n; ++$i) {
        for ($j = 0, $k = \count($calculated_category_path[$i]); $j < $k; ++$j) {
            $calculated_category_path_string .= $calculated_category_path[$i][$j]['text'].'&nbsp;&gt;&nbsp;';
        }

        $calculated_category_path_string = substr($calculated_category_path_string, 0, -16).'<br />';
    }

    $calculated_category_path_string = substr($calculated_category_path_string, 0, -6);

    if ($calculated_category_path_string === '') {
        $calculated_category_path_string = TEXT_TOP;
    }

    return $calculated_category_path_string;
}

function tep_get_generated_category_path_ids($id, $from = 'category')
{
    $calculated_category_path_string = '';
    $calculated_category_path = tep_generate_category_path($id, $from);

    for ($i = 0, $n = \count($calculated_category_path); $i < $n; ++$i) {
        for ($j = 0, $k = \count($calculated_category_path[$i]); $j < $k; ++$j) {
            $calculated_category_path_string .= $calculated_category_path[$i][$j]['id'].'_';
        }

        $calculated_category_path_string = substr($calculated_category_path_string, 0, -1).'<br />';
    }

    $calculated_category_path_string = substr($calculated_category_path_string, 0, -6);

    if ($calculated_category_path_string === '') {
        $calculated_category_path_string = TEXT_TOP;
    }

    return $calculated_category_path_string;
}

function tep_remove_category($category_id): void
{
    $category_image_query = tep_db_query("select categories_image from categories where categories_id = '".(int) $category_id."'");
    $category_image = tep_db_fetch_array($category_image_query);

    $duplicate_image_query = tep_db_query("select count(*) as total from categories where categories_image = '".tep_db_input($category_image['categories_image'])."'");
    $duplicate_image = tep_db_fetch_array($duplicate_image_query);

    if ($duplicate_image['total'] < 2) {
        if (file_exists(DIR_FS_CATALOG.'images/categories/'.$category_image['categories_image'])) {
            @unlink(DIR_FS_CATALOG.'images/categories/'.$category_image['categories_image']);
        }
    }

    tep_db_query("delete from categories where categories_id = '".(int) $category_id."'");
    tep_db_query("delete from categories_description where categories_id = '".(int) $category_id."'");
    tep_db_query("delete from products_to_categories where categories_id = '".(int) $category_id."'");

    if (USE_CACHE === 'true') {
        tep_reset_cache_block('categories');
        tep_reset_cache_block('also_purchased');
    }
}

function tep_remove_product($product_id): void
{
    $product_image_query = tep_db_query("select products_image from products where products_id = '".(int) $product_id."'");
    $product_image = tep_db_fetch_array($product_image_query);

    $duplicate_image_query = tep_db_query("select count(*) as total from products where products_image = '".tep_db_input($product_image['products_image'])."'");
    $duplicate_image = tep_db_fetch_array($duplicate_image_query);

    if ($duplicate_image['total'] < 2) {
        if (file_exists(DIR_FS_CATALOG.'images/products/thumbs/'.$product_image['products_image'])) {
            @unlink(DIR_FS_CATALOG.'images/products/thumbs/'.$product_image['products_image']);
        }

        if (file_exists(DIR_FS_CATALOG.'images/products/originals/'.$product_image['products_image'])) {
            @unlink(DIR_FS_CATALOG.'images/products/originals/'.$product_image['products_image']);
        }
    }

    $product_images_query = tep_db_query("select image from products_images where products_id = '".(int) $product_id."'");

    if (tep_db_num_rows($product_images_query)) {
        while ($product_images = tep_db_fetch_array($product_images_query)) {
            $duplicate_image_query = tep_db_query("select count(*) as total from products_images where image = '".tep_db_input($product_images['image'])."'");
            $duplicate_image = tep_db_fetch_array($duplicate_image_query);

            if ($duplicate_image['total'] < 2) {
                if (file_exists(DIR_FS_CATALOG.'images/products/thumbs/'.$product_images['image'])) {
                    @unlink(DIR_FS_CATALOG.'images/products/thumbs/'.$product_images['image']);
                }

                if (file_exists(DIR_FS_CATALOG.'images/products/originals/'.$product_images['image'])) {
                    @unlink(DIR_FS_CATALOG.'images/products/originals/'.$product_images['image']);
                }
            }
        }

        tep_db_query("delete from products_images where products_id = '".(int) $product_id."'");
    }

    tep_db_query("delete from specials where products_id = '".(int) $product_id."'");
    tep_db_query("delete from products where products_id = '".(int) $product_id."'");
    tep_db_query("delete from products_to_categories where products_id = '".(int) $product_id."'");
    tep_db_query("delete from products_description where products_id = '".(int) $product_id."'");
    tep_db_query("delete from products_attributes where products_id = '".(int) $product_id."'");
    tep_db_query("delete from customers_basket where products_id = '".(int) $product_id."' or products_id like '".(int) $product_id."{%'");
    tep_db_query("delete from customers_basket_attributes where products_id = '".(int) $product_id."' or products_id like '".(int) $product_id."{%'");
    tep_db_query("delete from customers_wishlist where products_id = '".(int) $product_id."' or products_id like '".(int) $product_id."{%'");
    tep_db_query("delete from customers_wishlist_attributes where products_id = '".(int) $product_id."' or products_id like '".(int) $product_id."{%'");

    tep_db_query("delete from reviews where products_id = '".(int) $product_id."'");

    if (USE_CACHE === 'true') {
        tep_reset_cache_block('categories');
        tep_reset_cache_block('also_purchased');
    }
}

function tep_remove_order($order_id, $restock = false): void
{
    if ($restock === 'on') {
        $order_query = tep_db_query("select products_id, products_quantity from orders_products where orders_id = '".(int) $order_id."'");

        while ($order = tep_db_fetch_array($order_query)) {
            tep_db_query('update products set products_quantity = products_quantity + '.(int) $order['products_quantity'].', products_ordered = products_ordered - '.(int) $order['products_quantity']." where products_id = '".(int) $order['products_id']."'");
        }
    }

    tep_db_query("delete from orders where orders_id = '".(int) $order_id."'");
    tep_db_query("delete from orders_products where orders_id = '".(int) $order_id."'");
    tep_db_query("delete from orders_products_attributes where orders_id = '".(int) $order_id."'");
    tep_db_query("delete from orders_status_history where orders_id = '".(int) $order_id."'");
    tep_db_query("delete from orders_total where orders_id = '".(int) $order_id."'");
}

function tep_reset_cache_block($cache_block): void
{
    global $cache_blocks;

    for ($i = 0, $n = \count($cache_blocks); $i < $n; ++$i) {
        if ($cache_blocks[$i]['code'] === $cache_block) {
            if ($cache_blocks[$i]['multiple']) {
                if ($dir = @opendir(DIR_FS_CACHE)) {
                    while ($cache_file = readdir($dir)) {
                        $cached_file = $cache_blocks[$i]['file'];
                        $languages = tep_get_languages();

                        for ($j = 0, $k = \count($languages); $j < $k; ++$j) {
                            $cached_file_unlink = preg_replace('/-language/', '-'.$languages[$j]['directory'], $cached_file);

                            if (preg_match('/^'.$cached_file_unlink.'/', $cache_file)) {
                                @unlink(DIR_FS_CACHE.$cache_file);
                            }
                        }
                    }

                    closedir($dir);
                }
            } else {
                $cached_file = $cache_blocks[$i]['file'];
                $languages = tep_get_languages();

                for ($i = 0, $n = \count($languages); $i < $n; ++$i) {
                    $cached_file = preg_replace('/-language/', '-'.$languages[$i]['directory'], $cached_file);
                    @unlink(DIR_FS_CACHE.$cached_file);
                }
            }

            break;
        }
    }
}

function tep_get_file_permissions($mode)
{
    // determine type
    if (($mode & 0xC000) === 0xC000) { // unix domain socket
        $type = 's';
    } elseif (($mode & 0x4000) === 0x4000) { // directory
        $type = 'd';
    } elseif (($mode & 0xA000) === 0xA000) { // symbolic link
        $type = 'l';
    } elseif (($mode & 0x8000) === 0x8000) { // regular file
        $type = '-';
    } elseif (($mode & 0x6000) === 0x6000) { // bBlock special file
        $type = 'b';
    } elseif (($mode & 0x2000) === 0x2000) { // character special file
        $type = 'c';
    } elseif (($mode & 0x1000) === 0x1000) { // named pipe
        $type = 'p';
    } else { // unknown
        $type = '?';
    }

    // determine permissions
    $owner['read'] = ($mode & 00400) ? 'r' : '-';
    $owner['write'] = ($mode & 00200) ? 'w' : '-';
    $owner['execute'] = ($mode & 00100) ? 'x' : '-';
    $group['read'] = ($mode & 00040) ? 'r' : '-';
    $group['write'] = ($mode & 00020) ? 'w' : '-';
    $group['execute'] = ($mode & 00010) ? 'x' : '-';
    $world['read'] = ($mode & 00004) ? 'r' : '-';
    $world['write'] = ($mode & 00002) ? 'w' : '-';
    $world['execute'] = ($mode & 00001) ? 'x' : '-';

    // adjust for SUID, SGID and sticky bit
    if ($mode & 0x800) {
        $owner['execute'] = ($owner['execute'] === 'x') ? 's' : 'S';
    }

    if ($mode & 0x400) {
        $group['execute'] = ($group['execute'] === 'x') ? 's' : 'S';
    }

    if ($mode & 0x200) {
        $world['execute'] = ($world['execute'] === 'x') ? 't' : 'T';
    }

    return $type.
           $owner['read'].$owner['write'].$owner['execute'].
           $group['read'].$group['write'].$group['execute'].
           $world['read'].$world['write'].$world['execute'];
}

function tep_remove($source): void
{
    global $messageStack, $tep_remove_error;

    if (isset($tep_remove_error)) {
        $tep_remove_error = false;
    }

    if (is_dir($source)) {
        $dir = dir($source);

        while ($file = $dir->read()) {
            if (($file !== '.') && ($file !== '..')) {
                if (tep_is_writable($source.'/'.$file)) {
                    tep_remove($source.'/'.$file);
                } else {
                    $messageStack->add(sprintf(ERROR_FILE_NOT_REMOVEABLE, $source.'/'.$file), 'error');
                    $tep_remove_error = true;
                }
            }
        }

        $dir->close();

        if (tep_is_writable($source)) {
            rmdir($source);
        } else {
            $messageStack->add(sprintf(ERROR_DIRECTORY_NOT_REMOVEABLE, $source), 'error');
            $tep_remove_error = true;
        }
    } else {
        if (tep_is_writable($source)) {
            unlink($source);
        } else {
            $messageStack->add(sprintf(ERROR_FILE_NOT_REMOVEABLE, $source), 'error');
            $tep_remove_error = true;
        }
    }
}

// //
// Output the tax percentage with optional padded decimals
function tep_display_tax_value($value, $padding = TAX_DECIMAL_PLACES)
{
    if (strpos($value, '.')) {
        $loop = true;

        while ($loop) {
            if (substr($value, -1) === '0') {
                $value = substr($value, 0, -1);
            } else {
                $loop = false;

                if (substr($value, -1) === '.') {
                    $value = substr($value, 0, -1);
                }
            }
        }
    }

    if ($padding > 0) {
        if ($decimal_pos = strpos($value, '.')) {
            $decimals = \strlen(substr($value, $decimal_pos + 1));

            for ($i = $decimals; $i < $padding; ++$i) {
                $value .= '0';
            }
        } else {
            $value .= '.';

            for ($i = 0; $i < $padding; ++$i) {
                $value .= '0';
            }
        }
    }

    return $value;
}

function tep_mail($to_name, $to_email_address, $email_subject, $email_text, $from_email_name, $from_email_address)
{
    if (SEND_EMAILS === 'false') {
        return false;
    }

    tep_wrap_smtp($to_name, $to_email_address, $email_subject, $email_text, $from_email_name, $from_email_address);
}

function tep_wrap_smtp($to_name, $to_email_address, $email_subject, $email_text, $from_email_name, $from_email_address)
{
    $numSent = 0;
    $debug = (EMAIL_SMTP_DEBUG === 'true' && EMAIL_TRANSPORT === 'smtp');
    $html = (EMAIL_USE_HTML === 'true' || $email_text !== strip_tags($email_text));

    if (EMAIL_TRANSPORT === 'smtp') {
        $transport = (new Swift_SmtpTransport(EMAIL_SMTP_HOST, EMAIL_SMTP_PORT, EMAIL_SMTP_ENCRYPTION))
            ->setUsername(EMAIL_SMTP_USERNAME)
            ->setPassword(EMAIL_SMTP_PASSWORD);
    } else {
        $sendmail_path = @\ini_get('sendmail_path');

        if ($sendmail_path === false || $sendmail_path === '') {
            $sendmail_path = '/usr/sbin/sendmail -bs';
        }

        $transport = new Swift_SendmailTransport($sendmail_path);
    }

    $mailer = new Swift_Mailer($transport);

    if ($debug) {
        $logger = new Swift_Plugins_Loggers_ArrayLogger();
        $mailer->registerPlugin(new Swift_Plugins_LoggerPlugin($logger));
    }

    $message = (new Swift_Message());

    if (\is_array($to_name) && empty($to_email_address)) {
        $to = $to_name;

        if (\count($to_name) > \count(explode(',', SEND_EXTRA_ORDER_EMAILS_TO))) {
            $mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(SEND_EMAIL_LIMIT, SEND_EMAIL_INTERVAL));
        }
    } else {
        $to = [$to_email_address => $to_name];
    }

    if (empty($from_email_address)) {
        $from = $from_email_name;
    } else {
        $from = [$from_email_address => $from_email_name];
    }

    if ($to_email_address === STORE_OWNER_EMAIL_ADDRESS) {  // the page contact us
        $message->setReplyTo($from);
        $from = $to;
    }

    $message->setPriority(5)
        ->setSubject($email_subject)
        ->setFrom($from);

    foreach ($to as $address => $name) {
        if (\is_int($address)) { // valid adrress
            $message->setTo($name);
        } else {
            $message->setTo([$address => $name]);
        }

        if ($html) {
            $message->setBody($email_text, 'text/html');
        } else {
            $message->setBody($email_text, 'text/plain');
        }

        $numSent += $mailer->send($message);
    }

    if ($debug) {
        if (is_writable(DIR_FS_CATALOG.'includes/work/mail_logs')) {
            file_put_contents(DIR_FS_CATALOG.'includes/work/mail_logs/mail-'.date('Ymd').'.txt', '['.date('d-M-Y H:i:s')."] \n".$logger->dump()."\n\n", \FILE_APPEND);
        }
    }

    return $numSent;
}

function tep_extra_emails_array($emails)
{
    $emails = explode(',', $emails);
    $new_emails = [];

    foreach ($emails as $email) {
        $new_emails[trim(strstr($email, '<'), '<>')] = trim(strstr($email, '<', true));
    }

    return $new_emails;
}

function tep_get_tax_class_title($tax_class_id)
{
    if ($tax_class_id === '0') {
        return TEXT_NONE;
    }

    $classes_query = tep_db_query("select tax_class_title from tax_class where tax_class_id = '".(int) $tax_class_id."'");
    $classes = tep_db_fetch_array($classes_query);

    return $classes['tax_class_title'];
}

function tep_banner_image_extension()
{
    if (\function_exists('imagetypes')) {
        if (imagetypes() & \IMG_PNG) {
            return 'png';
        }

        if (imagetypes() & \IMG_JPG) {
            return 'jpg';
        }

        if (imagetypes() & \IMG_GIF) {
            return 'gif';
        }
    } elseif (\function_exists('imagecreatefrompng') && \function_exists('imagepng')) {
        return 'png';
    } elseif (\function_exists('imagecreatefromjpeg') && \function_exists('imagejpeg')) {
        return 'jpg';
    } elseif (\function_exists('imagecreatefromgif') && \function_exists('imagegif')) {
        return 'gif';
    }

    return false;
}

// //
// Wrapper function for round() for php3 compatibility
function tep_round($value, $precision)
{
    return round($value, $precision);
}

// //
// Add tax to a products price
function tep_add_tax($price, $tax, $override = false)
{
    if (((DISPLAY_PRICE_WITH_TAX === 'true') || ($override === true)) && ($tax > 0)) {
        return $price + tep_calculate_tax($price, $tax);
    }

    return $price;
}

// Calculates Tax rounding the result
function tep_calculate_tax($price, $tax)
{
    return $price * $tax / 100;
}

// //
// Returns the tax rate for a zone / class
// TABLES: tax_rates, zones_to_geo_zones
function tep_get_tax_rate($class_id, $country_id = -1, $zone_id = -1)
{
    global $customer_zone_id, $customer_country_id;

    if (($country_id === -1) && ($zone_id === -1)) {
        if (!isset($_SESSION['customer_id'])) {
            $country_id = STORE_COUNTRY;
            $zone_id = STORE_ZONE;
        } else {
            $country_id = $customer_country_id;
            $zone_id = $customer_zone_id;
        }
    }

    $tax_query = tep_db_query("select SUM(tax_rate) as tax_rate from tax_rates tr left join zones_to_geo_zones za ON tr.tax_zone_id = za.geo_zone_id left join geo_zones tz ON tz.geo_zone_id = tr.tax_zone_id WHERE (za.zone_country_id IS NULL OR za.zone_country_id = '0' OR za.zone_country_id = '".(int) $country_id."') AND (za.zone_id IS NULL OR za.zone_id = '0' OR za.zone_id = '".(int) $zone_id."') AND tr.tax_class_id = '".(int) $class_id."' GROUP BY tr.tax_priority");

    if (tep_db_num_rows($tax_query)) {
        $tax_multiplier = 0;

        while ($tax = tep_db_fetch_array($tax_query)) {
            $tax_multiplier += $tax['tax_rate'];
        }

        return $tax_multiplier;
    }

    return 0;
}

// //
// Returns the tax rate for a tax class
// TABLES: tax_rates
function tep_get_tax_rate_value($class_id)
{
    return tep_get_tax_rate($class_id, -1, -1);
}

function tep_call_function($function, $parameter, $object = '')
{
    if ($object === '') {
        return $function($parameter);
    }

    return \call_user_func([$object, $function], $parameter);
}

function tep_get_zone_class_title($zone_class_id)
{
    if ($zone_class_id === '0') {
        return TEXT_NONE;
    }

    $classes_query = tep_db_query("select geo_zone_name from geo_zones where geo_zone_id = '".(int) $zone_class_id."'");
    $classes = tep_db_fetch_array($classes_query);

    return $classes['geo_zone_name'];
}

function tep_cfg_pull_down_zone_classes($zone_class_id, $key = '')
{
    $name = (($key) ? 'configuration['.$key.']' : 'configuration_value');

    $zone_class_array = [['id' => '0', 'text' => TEXT_NONE]];
    $zone_class_query = tep_db_query('SELECT geo_zone_id, geo_zone_name FROM geo_zones ORDER BY geo_zone_name');

    while ($zone_class = tep_db_fetch_array($zone_class_query)) {
        $zone_class_array[] = ['id' => $zone_class['geo_zone_id'],
            'text' => $zone_class['geo_zone_name']];
    }

    return tep_draw_pull_down_menu($name, $zone_class_array, $zone_class_id);
}

function tep_cfg_pull_down_order_statuses($order_status_id, $key = '')
{
    global $languages_id;

    $name = (($key) ? 'configuration['.$key.']' : 'configuration_value');

    $statuses_array = [['id' => '0', 'text' => TEXT_DEFAULT]];
    $statuses_query = tep_db_query("select orders_status_id, orders_status_name from orders_status where language_id = '".(int) $languages_id."' order by orders_status_name");

    while ($statuses = tep_db_fetch_array($statuses_query)) {
        $statuses_array[] = ['id' => $statuses['orders_status_id'],
            'text' => $statuses['orders_status_name']];
    }

    return tep_draw_pull_down_menu($name, $statuses_array, $order_status_id);
}

function tep_get_order_status_name($order_status_id, $language_id = '')
{
    global $languages_id;

    if ($order_status_id < 1) {
        return TEXT_DEFAULT;
    }

    if (!is_numeric($language_id)) {
        $language_id = $languages_id;
    }

    $status_query = tep_db_query("select orders_status_name from orders_status where orders_status_id = '".(int) $order_status_id."' and language_id = '".(int) $language_id."'");
    $status = tep_db_fetch_array($status_query);

    return $status['orders_status_name'];
}

// //
// Return a random value
function tep_rand($min = null, $max = null)
{
    if (isset($min, $max)) {
        if ($min >= $max) {
            return $min;
        }

        return mt_rand($min, $max);
    }

    return mt_rand();
}

// nl2br() prior PHP 4.2.0 did not convert linefeeds on all OSs (it only converted \n)
function tep_convert_linefeeds($from, $to, $string)
{
    return str_replace($from, $to, $string);
}

// //
// Parse and secure the cPath parameter values
function tep_parse_category_path($cPath)
{
    $int = static function ($string) {
        return (int) $string;
    };

    // make sure the category IDs are integers
    $cPath_array = array_map($int, explode('_', $cPath));

    // make sure no duplicate category IDs exist which could lock the server in a loop
    $tmp_array = [];
    $n = \count($cPath_array);

    for ($i = 0; $i < $n; ++$i) {
        if (!\in_array($cPath_array[$i], $tmp_array, true)) {
            $tmp_array[] = $cPath_array[$i];
        }
    }

    return $tmp_array;
}

function tep_validate_ip_address($ip_address)
{
    return filter_var($ip_address, \FILTER_VALIDATE_IP, ['flags' => \FILTER_FLAG_IPV4]);
}

function tep_get_ip_address()
{
    $ip_address = null;
    $ip_addresses = [];

    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        foreach (array_reverse(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])) as $x_ip) {
            $x_ip = trim($x_ip);

            if (tep_validate_ip_address($x_ip)) {
                $ip_addresses[] = $x_ip;
            }
        }
    }

    if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip_addresses[] = $_SERVER['HTTP_CLIENT_IP'];
    }

    if (isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && !empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
        $ip_addresses[] = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    }

    if (isset($_SERVER['HTTP_PROXY_USER']) && !empty($_SERVER['HTTP_PROXY_USER'])) {
        $ip_addresses[] = $_SERVER['HTTP_PROXY_USER'];
    }

    if (isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR'])) {
        $ip_addresses[] = $_SERVER['REMOTE_ADDR'];
    }

    foreach ($ip_addresses as $ip) {
        if (!empty($ip) && tep_validate_ip_address($ip)) {
            $ip_address = $ip;

            break;
        }
    }

    return $ip_address;
}

// //
// Wrapper function for is_writable() for Windows compatibility
function tep_is_writable($file)
{
    if (strtolower(substr(\PHP_OS, 0, 3)) === 'win') {
        if (file_exists($file)) {
            $file = realpath($file);

            if (is_dir($file)) {
                $result = @tempnam($file, 'osc');

                if (\is_string($result) && file_exists($result)) {
                    unlink($result);

                    return (strpos($result, $file) === 0) ? true : false;
                }
            } else {
                $handle = @fopen($file, 'r+b');

                if (\is_resource($handle)) {
                    fclose($handle);

                    return true;
                }
            }
        } else {
            $dir = \dirname($file);

            if (file_exists($dir) && is_dir($dir) && tep_is_writable($dir)) {
                return true;
            }
        }

        return false;
    }

    return is_writable($file);
}

function tep_cfg_select_multioption($select_array, $key_value, $key = null)
{
    $string = '';
    $key_value = explode(', ', $key_value);

    for ($i = 0, $n = \count($select_array); $i < $n; ++$i) {
        $name = (!empty($key) ? 'configuration['.$key.'][]' : 'configuration_value');

        $string .= '<br />'.tep_draw_checkbox_field($name, $select_array[$i], \in_array($select_array[$i], $key_value, true)).$select_array[$i];
    }

    $string .= tep_draw_hidden_field($name, '--none--');

    return $string;
}

function tep_set_custom_pages()
{
    return ['index.php',
        'product_info.php',
        'products_new.php',
        'specials.php'];
}

function tep_cfg_show_pages($string)
{
    return nl2br(implode("\n", explode(';', $string)));
}

function tep_cfg_edit_pages($values, $key)
{
    $files_array = [];
    $exclude_array = ['checkout_process.php',
        'download.php',
        'opensearch.php',
        'redirect.php',
        'sitemap.php',
        'ssl_check.php'];

    if ($dir = @dir(DIR_FS_CATALOG)) {
        while ($file = $dir->read()) {
            if (!is_dir(DIR_FS_CATALOG.$file) && !\in_array($file, $exclude_array, true)) {
                if (substr($file, strrpos($file, '.')) === '.php') {
                    $files_array[] = $file;
                }
            }
        }

        sort($files_array);
        $dir->close();
    }

    $values_array = explode(';', $values);

    $output = '<input type="checkbox" id="checked-all"><b>All</b><br />';

    foreach ($files_array as $file) {
        $output .= tep_draw_checkbox_field('page_files[]', $file, \in_array($file, $values_array, true)).'&nbsp;'.tep_output_string($file).'<br />';
    }

    if (!empty($output)) {
        $output = '<br />'.substr($output, 0, -6);
    }

    $output .= tep_draw_hidden_field('configuration['.$key.']', '', 'id="page-files"');

    $output .= <<<'EOT'
<script>
function module_update_cfg_value() {
  let module_selected_files = '';
  const pageFiles = $('input[name="page_files[]"]');
  const checkedAll = $('#checked-all');

  if (pageFiles.length > 0) {
    $('input[name="page_files[]"]:checked').each(function() {
      module_selected_files += $(this).attr('value') + ';';
      checkedAll.prop('checked', false);
    });

    if ($('input[name="page_files[]"]:checkbox:not(":checked")').length === 0) {
      checkedAll.prop('checked', true);
    }

    if (module_selected_files.length > 0) {
      module_selected_files = module_selected_files.substring(0, module_selected_files.length - 1);
    }
  }

  $('#page-files').val(module_selected_files);
}

$(function() {
  const pageFiles = $('input[name="page_files[]"]');
  const checkedAll = $('#checked-all');

  module_update_cfg_value();

  if (pageFiles.length > 0) {
    pageFiles.change(function() {
      module_update_cfg_value();
    });
  }

  if ($('input[name="page_files[]"]:checkbox:not(":checked")').length === 0) {
    checkedAll.prop('checked', true);
  }

  checkedAll.change(function() {
    let module_selected_files = '';
    const selectedFiles = $('#page-files');

    pageFiles.each(function() {
      if (checkedAll.is(':checked')) {
        module_selected_files += $(this).attr('value') + ';';

        $(this).prop('checked', true);
      } else {
        $(this).prop('checked', false);
      }
    });

    selectedFiles.val(module_selected_files);
  });
});
</script>
EOT;

    return $output;
}

function tep_get_category_description($category_id, $language_id)
{
    $category_query = tep_db_query("select categories_description from categories_description where categories_id = '".(int) $category_id."' and language_id = '".(int) $language_id."'");
    $category = tep_db_fetch_array($category_query);

    return $category['categories_description'];
}

function tep_resize_image($old_image, $new_image, $width = null, $height = null, $quality = 90): void
{
    $image_type = false;
    $ext = strtolower(substr($old_image, strrpos($old_image, '.') + 1));

    switch ($ext) {
        case 'jpg':
        case 'jpeg':
            if (imagetypes() & \IMG_JPG) {
                $image_type = 'jpg';
                $im = imagecreatefromjpeg($old_image);
            }

            break;
        case 'gif':
            if (imagetypes() & \IMG_GIF) {
                $image_type = 'gif';
                $im = imagecreatefromgif($old_image);
            }

            break;
        case 'png':
            if (imagetypes() & \IMG_PNG) {
                $image_type = 'png';
                $im = imagecreatefrompng($old_image);
            }

            break;
    }

    if ($image_type !== false) {
        [$orig_width, $orig_height] = getimagesize($old_image);

        if (!empty($width) && empty($height)) {
            $height = round($orig_height * $width / $orig_width);
        } elseif (empty($width) && !empty($height)) {
            $width = (int) ($orig_width * $height / $orig_height);
        } elseif (empty($width) && empty($height)) {
            $height = $orig_height;
            $width = $orig_width;
        }

        $im_p = imagecreatetruecolor($width, $height);

        imagecopyresampled($im_p, $im, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);

        switch ($image_type) {
            case 'jpg':
            case 'jpeg':
                imagejpeg($im_p, $new_image, $quality);

                break;
            case 'gif':
                imagegif($im_p, $new_image);

                break;
            case 'png':
                imagepng($im_p, $new_image, round(abs(($quality - 100) / 11.11)));

                break;
        }

        imagedestroy($im_p);
        imagedestroy($im);
    }
}

/**
 * ULTIMATE Seo Urls 5 PRO by FWR Media
 * Reset the various cache systems.
 *
 * @param string $action
 */
function tep_reset_cache_data_usu5($action = false): void
{
    if ($action === 'reset') {
        $usu5_path = realpath(__DIR__.'/../../../').'/'.DIR_WS_MODULES.'ultimate_seo_urls5/';

        switch (USU5_CACHE_SYSTEM) {
            case 'file':
                $path_to_cache = $usu5_path.'cache_system/cache/';
                $it = new DirectoryIterator($path_to_cache);

                while ($it->valid()) {
                    if (!$it->isDot() && is_readable($path_to_cache.$it->getFilename()) && (substr($it->getFilename(), -6) === '.cache')) {
                        @unlink($path_to_cache.$it->getFilename());
                    }

                    $it->next();
                }

                break;
            case 'mysql':
                tep_db_query('TRUNCATE TABLE `usu_cache`');

                break;
            case 'memcache':
                if (class_exists('Memcache')) {
                    include $usu5_path.'interfaces/cache_interface.php';

                    include $usu5_path.'cache_system/memcache.php';
                    Memcache_Cache_Module::iAdmin()->initiate()
                        ->flushOut();
                }

                break;
            case 'sqlite':
                include $usu5_path.'interfaces/cache_interface.php';

                include $usu5_path.'cache_system/sqlite.php';
                Sqlite_Cache_Module::admini()->gc();

                break;
        }

        tep_db_query('UPDATE '.TABLE_CONFIGURATION." SET configuration_value='false' WHERE configuration_key='USU5_RESET_CACHE'");
    }
} // end function
