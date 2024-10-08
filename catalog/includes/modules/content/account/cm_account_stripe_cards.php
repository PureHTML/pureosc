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
class cm_account_stripe_cards
{
    public $code;
    public $group;
    public $title;
    public $description;
    public $sort_order;
    public $enabled = false;

    public function __construct()
    {
        global $language;

        $this->code = \get_class($this);
        $this->group = basename(__DIR__);

        $this->title = MODULE_CONTENT_ACCOUNT_STRIPE_CARDS_TITLE;
        $this->description = MODULE_CONTENT_ACCOUNT_STRIPE_CARDS_DESCRIPTION;

        if (\defined('MODULE_CONTENT_ACCOUNT_STRIPE_CARDS_STATUS')) {
            $this->sort_order = MODULE_CONTENT_ACCOUNT_STRIPE_CARDS_SORT_ORDER;
            $this->enabled = (MODULE_CONTENT_ACCOUNT_STRIPE_CARDS_STATUS === 'True');
        }

        $this->public_title = MODULE_CONTENT_ACCOUNT_STRIPE_CARDS_LINK_TITLE;

        $stripe_enabled = false;

        if (\defined('MODULE_PAYMENT_INSTALLED') && !empty(MODULE_PAYMENT_INSTALLED) && \in_array('stripe.php', explode(';', MODULE_PAYMENT_INSTALLED), true)) {
            if (!class_exists('stripe')) {
                include DIR_FS_CATALOG.'includes/languages/'.$language.'/modules/payment/stripe.php';

                include DIR_FS_CATALOG.'includes/modules/payment/stripe.php';
            }

            $stripe = new stripe();

            if ($stripe->enabled) {
                $stripe_enabled = true;

                if (MODULE_PAYMENT_STRIPE_TRANSACTION_SERVER === 'Test') {
                    $this->title .= ' [Test]';
                    $this->public_title .= ' ('.$stripe->code.'; Test)';
                }
            }
        }

        if ($stripe_enabled !== true) {
            $this->enabled = false;

            $this->description = '<div class="secWarning">'.MODULE_CONTENT_ACCOUNT_STRIPE_CARDS_ERROR_MAIN_MODULE.'</div>'.$this->description;
        }
    }

    public function execute(): void
    {
        global $oscTemplate;

        $oscTemplate->_data['account']['account']['links']['stripe_cards'] = ['title' => $this->public_title,
            'link' => tep_href_link('ext/modules/content/account/stripe/cards.php'),
            'icon' => 'newwin'];
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function check()
    {
        return \defined('MODULE_CONTENT_ACCOUNT_STRIPE_CARDS_STATUS');
    }

    public function install(): void
    {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Stripe Card Management', 'MODULE_CONTENT_ACCOUNT_STRIPE_CARDS_STATUS', 'True', 'Do you want to enable the Stripe Card Management module?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_ACCOUNT_STRIPE_CARDS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_CONTENT_ACCOUNT_STRIPE_CARDS_STATUS', 'MODULE_CONTENT_ACCOUNT_STRIPE_CARDS_SORT_ORDER'];
    }
}
