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
class mc360
{
    public $system = 'osc';
    public $version = '1.1';
    public $debug = false;
    public $apikey = '';
    public $key_valid = false;
    public $store_id = '';

    public function __construct()
    {
        $this->apikey = MODULE_HEADER_TAGS_MAILCHIMP_360_API_KEY;
        $this->store_id = MODULE_HEADER_TAGS_MAILCHIMP_360_STORE_ID;
        $this->key_valid = ((MODULE_HEADER_TAGS_MAILCHIMP_360_KEY_VALID === 'true') ? true : false);

        if (!empty(MODULE_HEADER_TAGS_MAILCHIMP_360_DEBUG_EMAIL)) {
            $this->debug = true;
        }

        $this->validate_cfg();
    }

    public function complain($msg): void
    {
        echo '<div style="position:absolute;left:0;top:0;width:100%;font-size:24px;text-align:center;background:#CCCCCC;color:#660000">MC360 Module: '.$msg.'</div><br />';
    }

    public function validate_cfg(): void
    {
        $this->valid_cfg = false;

        if (empty($this->apikey)) {
            $this->complain('You have not entered your API key. Please read the installation instructions.');

            return;
        }

        if (!$this->key_valid) {
            $GLOBALS['mc_api_key'] = $this->apikey;
            $api = new MCAPI('notused', 'notused');
            $res = $api->ping();

            if ($api->errorMessage !== '') {
                $this->complain('Server said: "'.$api->errorMessage.'". Your API key is likely invalid. Please read the installation instructions.');

                return;
            }

            $this->key_valid = true;
            tep_db_query("update configuration set configuration_value = 'true' where configuration_key = 'MODULE_HEADER_TAGS_MAILCHIMP_360_KEY_VALID'");

            if (empty($this->store_id)) {
                $this->store_id = md5(uniqid(mt_rand(), true));
                tep_db_query("update configuration set configuration_value = '".tep_db_input($this->store_id)."' where configuration_key = 'MODULE_HEADER_TAGS_MAILCHIMP_360_STORE_ID'");
            }
        }

        if (empty($this->store_id)) {
            $this->complain('Your Store ID has not been set. This is not good. Contact support.');
        } else {
            $this->valid_cfg = true;
        }
    }
    public function set_cookies(): void
    {
        if (!$this->valid_cfg) {
            return;
        }

        $thirty_days = time() + 60 * 60 * 24 * 30;

        if (isset($_REQUEST['mc_cid'])) {
            setcookie('mailchimp_campaign_id', trim($_REQUEST['mc_cid']), $thirty_days);
        }

        if (isset($_REQUEST['mc_eid'])) {
            setcookie('mailchimp_email_id', trim($_REQUEST['mc_eid']), $thirty_days);
        }
    }

    public function process(): void
    {
        if (!$this->valid_cfg) {
            return;
        }

        global $order, $insert_id;

        $orderId = $insert_id; // just to make it obvious.

        $debug_email = '';

        if ($this->debug) {
            $debug_email .= '------------[New Order '.$orderId."]-----------------\n".
                            '$order ='."\n".
                            print_r($order, true).
                            '$_COOKIE ='."\n".
                            print_r($_COOKIE, true);
        }

        if (!isset($_COOKIE['mailchimp_campaign_id']) || !isset($_COOKIE['mailchimp_email_id'])) {
            return;
        }

        if ($this->debug) {
            $debug_email .= date('Y-m-d H:i:s')." current ids:\n".
                            date('Y-m-d H:i:s').' eid ='.$_COOKIE['mailchimp_email_id']."\n".
                            date('Y-m-d H:i:s').' cid ='.$_COOKIE['mailchimp_campaign_id']."\n";
        }

        $customer_id = $_SESSION['customer_id'];

        $orders_query = tep_db_query("select orders_id from orders where customers_id = '".(int) $customer_id."' order by date_purchased desc limit 1");
        $orders = tep_db_fetch_array($orders_query);

        $totals_array = [];
        $totals_query = tep_db_query('select value, class from orders_total where orders_id = '.(int) $orders['orders_id']);

        while ($totals = tep_db_fetch_array($totals_query)) {
            $totals_array[$totals['class']] = $totals['value'];
        }

        $products_array = [];
        $products_query = tep_db_query('select products_id, products_model, products_name, products_tax, products_quantity, final_price from orders_products where orders_id = '.(int) $orders['orders_id']);

        while ($products = tep_db_fetch_array($products_query)) {
            $products_array[] = ['id' => $products['products_id'],
                'name' => $products['products_name'],
                'model' => $products['products_model'],
                'qty' => $products['products_quantity'],
                'final_price' => $products['final_price'],
            ];
            $totals_array['ot_tax'] += $products['product_tax'];
        }

        $mcorder = [
            'id' => $orders['orders_id'],
            'total' => $totals_array['ot_total'],
            'shipping' => $totals_array['ot_shipping'],
            'tax' => $totals_array['ot_tax'],
            'items' => [],
            'store_id' => $this->store_id,
            'store_name' => $_SERVER['SERVER_NAME'],
            'campaign_id' => $_COOKIE['mailchimp_campaign_id'],
            'email_id' => $_COOKIE['mailchimp_email_id'],
            'plugin_id' => 1216,
        ];

        foreach ($products_array as $product) {
            $item = [];
            $item['line_num'] = $line;
            $item['product_id'] = $product['id'];
            $item['product_name'] = $product['name'];
            $item['sku'] = $product['model'];
            $item['qty'] = $product['qty'];
            $item['cost'] = $product['final_price'];

            // All this to get a silly category name from here
            $cat_qry = tep_db_query('select categories_id from products_to_categories where products_id = '.(int) $product['id'].' limit 1');
            $cats = tep_db_fetch_array($cat_qry);
            $cat_id = $cats['categories_id'];

            $item['category_id'] = $cat_id;
            $cat_name === '';
            $continue = true;

            while ($continue) {
                // now recurse up the categories tree...
                $cat_qry = tep_db_query('select c.categories_id, c.parent_id, cd.categories_name from  categories c inner join categories_description cd on c.categories_id = cd.categories_id where c.categories_id ='.(int) $cat_id);
                $cats = tep_db_fetch_array($cat_qry);

                if ($cat_name === '') {
                    $cat_name = $cats['categories_name'];
                } else {
                    $cat_name = $cats['categories_name'].' - '.$cat_name;
                }

                $cat_id = $cats['parent_id'];

                if ($cat_id === 0) {
                    $continue = false;
                }
            }

            $item['category_name'] = $cat_name;

            $mcorder['items'][] = $item;
        }

        $GLOBALS['mc_api_key'] = $this->apikey;
        $api = new MCAPI('notused', 'notused');
        $res = $api->campaignEcommAddOrder($mcorder);

        if ($api->errorMessage !== '') {
            if ($this->debug) {
                $debug_email .= "Error:\n".
                                 $api->errorMessage."\n";
            }
        }

        // nothing

        // send!()

        if ($this->debug && !empty($debug_email)) {
            tep_mail('', MODULE_HEADER_TAGS_MAILCHIMP_360_DEBUG_EMAIL, 'MailChimp Debug E-Mail', $debug_email, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
        }
    }// update
}// mc360 class
