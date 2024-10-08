<?php

declare(strict_types=1);

/**
 * osCommerce, Open Source E-Commerce Solutions
 * http://www.oscommerce.com
 *
 * Copyright (c) 2020 osCommerce
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

/**
 * This file is part of the DvereCOM package.
 *
 *  (c) Šimon Formánek <mail@simonformanek.cz>
 * This file is part of the MultiFlexi package
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class ht_google_analytics
{
    public $code = 'ht_google_analytics';
    public $group = 'header_tags';
    public $title;
    public $description;
    public $sort_order;
    public $enabled = false;
    public $cookie_group = 'statistics';

    public function __construct()
    {
        $this->title = MODULE_HEADER_TAGS_GOOGLE_ANALYTICS_TITLE;
        $this->description = MODULE_HEADER_TAGS_GOOGLE_ANALYTICS_DESCRIPTION;

        if ($this->check()) {
            $this->sort_order = MODULE_HEADER_TAGS_GOOGLE_ANALYTICS_SORT_ORDER;
            $this->enabled = (MODULE_HEADER_TAGS_GOOGLE_ANALYTICS_STATUS === 'True');
        }
    }

    public function execute(): void
    {
        global $PHP_SELF, $oscTemplate, $customer_id;

        if (!empty(MODULE_HEADER_TAGS_GOOGLE_ANALYTICS_ID)) {
            if (MODULE_HEADER_TAGS_GOOGLE_ANALYTICS_JS_PLACEMENT !== 'Header') {
                $this->group = 'footer_scripts';
            }

            $header = <<<'EOD'
<script>
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '
EOD.tep_output_string(MODULE_HEADER_TAGS_GOOGLE_ANALYTICS_ID).<<<'EOD'
']);
  _gaq.push(['_trackPageview']);
EOD."\n";

            if ((MODULE_HEADER_TAGS_GOOGLE_ANALYTICS_EC_TRACKING === 'True') && (basename($PHP_SELF) === 'checkout_success.php') && isset($_SESSION['customer_id'])) {
                $order_query = tep_db_query("select orders_id, billing_city, billing_state, billing_country from orders where customers_id = '".(int) $customer_id."' order by date_purchased desc limit 1");

                if (tep_db_num_rows($order_query) === 1) {
                    $order = tep_db_fetch_array($order_query);

                    $totals = [];

                    $order_totals_query = tep_db_query("select value, class from orders_total where orders_id = '".(int) $order['orders_id']."'");

                    while ($order_totals = tep_db_fetch_array($order_totals_query)) {
                        $totals[$order_totals['class']] = $order_totals['value'];
                    }

                    $header .= <<<'EOD'
  _gaq.push(['_addTrans',
    '
EOD.(int) $order['orders_id'].<<<'EOD'
', // order ID - required
    '
EOD.tep_output_string(STORE_NAME).<<<'EOD'
', // store name
    '
EOD.(isset($totals['ot_total']) ? $this->format_raw($totals['ot_total'], DEFAULT_CURRENCY) : 0).<<<'EOD'
', // total - required
    '
EOD.(isset($totals['ot_tax']) ? $this->format_raw($totals['ot_tax'], DEFAULT_CURRENCY) : 0).<<<'EOD'
', // tax
    '
EOD.(isset($totals['ot_shipping']) ? $this->format_raw($totals['ot_shipping'], DEFAULT_CURRENCY) : 0).<<<'EOD'
', // shipping
    '
EOD.tep_output_string_protected($order['billing_city']).<<<'EOD'
', // city
    '
EOD.tep_output_string_protected($order['billing_state']).<<<'EOD'
', // state or province
    '
EOD.tep_output_string_protected($order['billing_country']).<<<'EOD'
' // country
  ]);
EOD."\n";

                    $order_products_query = tep_db_query("select op.products_id, pd.products_name, op.final_price, op.products_quantity from orders_products op, products_description pd, languages l where op.orders_id = '".(int) $order['orders_id']."' and op.products_id = pd.products_id and l.code = '".tep_db_input(DEFAULT_LANGUAGE)."' and l.languages_id = pd.language_id");

                    while ($order_products = tep_db_fetch_array($order_products_query)) {
                        $category_query = tep_db_query("select cd.categories_name from categories_description cd, products_to_categories p2c, languages l where p2c.products_id = '".(int) $order_products['products_id']."' and p2c.categories_id = cd.categories_id and l.code = '".tep_db_input(DEFAULT_LANGUAGE)."' and l.languages_id = cd.language_id limit 1");
                        $category = tep_db_fetch_array($category_query);

                        $header .= <<<'EOD'
  _gaq.push(['_addItem',
    '
EOD.(int) $order['orders_id'].<<<'EOD'
', // order ID - required
    '
EOD.(int) $order_products['products_id'].<<<'EOD'
', // SKU/code - required
    '
EOD.tep_output_string($order_products['products_name']).<<<'EOD'
', // product name
    '
EOD.tep_output_string($category['categories_name']).<<<'EOD'
', // category
    '
EOD.$this->format_raw($order_products['final_price']).<<<'EOD'
', // unit price - required
    '
EOD.(int) $order_products['products_quantity'].<<<'EOD'
' // quantity - required
  ]);
EOD."\n";
                    }

                    $header .= '  _gaq.push([\'_trackTrans\']); //submits transaction to the Analytics servers'."\n";
                }
            }

            $header .= <<<'EOD'
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
EOD."\n";

            $oscTemplate->addBlock($header, $this->group);
        }
    }

    public function format_raw($number, $currency_code = '', $currency_value = '')
    {
        global $currencies, $currency;

        if (empty($currency_code) || !$currencies->is_set($currency_code)) {
            $currency_code = $currency;
        }

        if (empty($currency_value) || !is_numeric($currency_value)) {
            $currency_value = $currencies->currencies[$currency_code]['value'];
        }

        return number_format(tep_round($number * $currency_value, $currencies->currencies[$currency_code]['decimal_places']), $currencies->currencies[$currency_code]['decimal_places'], '.', '');
    }

    public function isEnabled()
    {
        if (\defined('MODULE_HEADER_TAGS_GOOGLE_ANALYTICS_ID') && !empty(MODULE_HEADER_TAGS_GOOGLE_ANALYTICS_ID)) {
            if (!isset($_COOKIE['cookieAccepted']) || (isset($_COOKIE['cookieAccepted']) && !\in_array($this->cookie_group, json_decode(stripslashes($_COOKIE['cookieAccepted'])), true))) {
                return $this->enabled;
            }
        }

        return false;
    }

    public function check()
    {
        return \defined('MODULE_HEADER_TAGS_GOOGLE_ANALYTICS_STATUS');
    }

    public function install(): void
    {
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Google Analytics Module', 'MODULE_HEADER_TAGS_GOOGLE_ANALYTICS_STATUS', 'True', 'Do you want to add Google Analytics to your shop?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', NOW())");
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Google Analytics ID', 'MODULE_HEADER_TAGS_GOOGLE_ANALYTICS_ID', '', 'The Google Analytics profile ID to track.', '6', '0', NOW())");
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('E-Commerce Tracking', 'MODULE_HEADER_TAGS_GOOGLE_ANALYTICS_EC_TRACKING', 'True', 'Do you want to enable e-commerce tracking? (E-Commerce tracking must also be enabled in your Google Analytics profile settings)', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', NOW())");
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Javascript Placement', 'MODULE_HEADER_TAGS_GOOGLE_ANALYTICS_JS_PLACEMENT', 'Header', 'Should the Google Analytics javascript be loaded in the header or footer?', '6', '1', 'tep_cfg_select_option(array(\\'Header\\', \\'Footer\\'), ', NOW())");
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort Order', 'MODULE_HEADER_TAGS_GOOGLE_ANALYTICS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', NOW())");
    }

    public function remove(): void
    {
        tep_db_query("DELETE FROM configuration WHERE configuration_key IN ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_HEADER_TAGS_GOOGLE_ANALYTICS_STATUS', 'MODULE_HEADER_TAGS_GOOGLE_ANALYTICS_ID', 'MODULE_HEADER_TAGS_GOOGLE_ANALYTICS_EC_TRACKING', 'MODULE_HEADER_TAGS_GOOGLE_ANALYTICS_JS_PLACEMENT', 'MODULE_HEADER_TAGS_GOOGLE_ANALYTICS_SORT_ORDER'];
    }
}
