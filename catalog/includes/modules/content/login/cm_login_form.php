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
class cm_login_form
{
    public $code;
    public $group;
    public $title;
    public $description;
    public $sort_order;
    public $enabled = false;

    public function __construct()
    {
        $this->code = \get_class($this);
        $this->group = basename(__DIR__);

        $this->title = MODULE_CONTENT_LOGIN_FORM_TITLE;
        $this->description = MODULE_CONTENT_LOGIN_FORM_DESCRIPTION;

        if (\defined('MODULE_CONTENT_LOGIN_FORM_STATUS')) {
            $this->sort_order = MODULE_CONTENT_LOGIN_FORM_SORT_ORDER;
            $this->enabled = (MODULE_CONTENT_LOGIN_FORM_STATUS === 'True');
        }
    }

    public function execute(): void
    {
        global $sessiontoken, $login_customer_id, $messageStack, $oscTemplate;

        $error = false;

        if (isset($_GET['action']) && ($_GET['action'] === 'process') && isset($_POST['formid']) && ($_POST['formid'] === $sessiontoken)) {
            $email_address = tep_db_prepare_input($_POST['email_address']);
            $password = tep_db_prepare_input($_POST['password']);

            // Check if email exists
            $customer_query = tep_db_query("select customers_id, customers_password from customers where customers_email_address = '".tep_db_input($email_address)."' limit 1");

            if (!tep_db_num_rows($customer_query)) {
                $error = true;
            } else {
                $customer = tep_db_fetch_array($customer_query);

                // Check that password is good
                if (!tep_validate_password($password, $customer['customers_password'])) {
                    $error = true;
                } else {
                    // set $login_customer_id globally and perform post login code in catalog/login.php
                    $login_customer_id = (int) $customer['customers_id'];

                    // migrate old hashed password to new phpass password
                    if (tep_password_type($customer['customers_password']) !== 'phpass') {
                        tep_db_query("update customers set customers_password = '".tep_encrypt_password($password)."' where customers_id = '".(int) $login_customer_id."'");
                    }
                }
            }
        }

        if ($error === true) {
            $messageStack->add('login', MODULE_CONTENT_LOGIN_TEXT_LOGIN_ERROR);
        }

        ob_start();

        include 'includes/modules/content/'.$this->group.'/templates/login_form.php';
        $template = ob_get_clean();

        $oscTemplate->addContent($template, $this->group);
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function check()
    {
        return \defined('MODULE_CONTENT_LOGIN_FORM_STATUS');
    }

    public function install(): void
    {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Login Form Module', 'MODULE_CONTENT_LOGIN_FORM_STATUS', 'True', 'Do you want to enable the login form module?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_LOGIN_FORM_SORT_ORDER', '1', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_CONTENT_LOGIN_FORM_STATUS', 'MODULE_CONTENT_LOGIN_FORM_SORT_ORDER'];
    }
}
