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

if (!class_exists('OSCOM_Braintree')) {
    include DIR_FS_CATALOG.'includes/apps/braintree/OSCOM_Braintree.php';
}

class cm_account_braintree_cards
{
    public $code;
    public $group;
    public $title;
    public $description;
    public $sort_order;
    public $enabled = false;
    public $_app;

    public function __construct()
    {
        global $language;

        $this->_app = new OSCOM_Braintree();
        $this->_app->loadLanguageFile('shop/account_cards_page.php');

        $this->code = \get_class($this);
        $this->group = basename(__DIR__);

        $this->title = $this->_app->getDef('account_braintree_cards_title');
        $this->description = $this->_app->getDef('account_braintree_cards_description').'<div align="center">'.$this->_app->drawButton($this->_app->getDef('accouint_braintree_cards_legacy_admin_app_button'), tep_href_link('braintree.php', 'action=configure&module=CC'), 'primary', null, true).'</div>';

        if (\defined('MODULE_CONTENT_ACCOUNT_BRAINTREE_CARDS_SORT_ORDER')) {
            $this->sort_order = MODULE_CONTENT_ACCOUNT_BRAINTREE_CARDS_SORT_ORDER;
            $this->enabled = \defined('OSCOM_APP_PAYPAL_BRAINTREE_CC_STATUS') && \in_array(OSCOM_APP_PAYPAL_BRAINTREE_CC_STATUS, ['1', '0'], true) ? true : false;
        }

        $this->public_title = $this->_app->getDef('account_braintree_cards_link_title');

        $braintree_enabled = false;

        if (\defined('MODULE_PAYMENT_INSTALLED') && !empty(MODULE_PAYMENT_INSTALLED) && \in_array('braintree_cc.php', explode(';', MODULE_PAYMENT_INSTALLED), true)) {
            if (!class_exists('braintree_cc')) {
                include DIR_FS_CATALOG.'includes/languages/'.$language.'/modules/payment/braintree_cc.php';

                include DIR_FS_CATALOG.'includes/modules/payment/braintree_cc.php';
            }

            $braintree_cc = new braintree_cc();

            if ($braintree_cc->enabled) {
                if (\defined('OSCOM_APP_PAYPAL_BRAINTREE_CC_STATUS')) {
                    $braintree_enabled = true;

                    if (OSCOM_APP_PAYPAL_BRAINTREE_CC_STATUS === '0') {
                        $this->title .= ' [Sandbox]';
                        $this->public_title .= ' ('.$braintree_cc->code.'; Sandbox)';
                    }

                    if (OSCOM_APP_PAYPAL_BRAINTREE_CC_CC_TOKENS === '0') {
                        $braintree_enabled = false;
                    }
                }
            }
        }

        if ($braintree_enabled !== true) {
            $this->enabled = false;

            $this->description = '<div class="secWarning">'.$this->_app->getDef('account_braintree_cards_error_main_module').'</div>'.$this->description;
        }
    }

    public function execute(): void
    {
        global $oscTemplate;

        $oscTemplate->_data['account']['account']['links']['braintree_cards'] = ['title' => $this->public_title,
            'link' => tep_href_link('ext/modules/content/account/braintree/cards.php'),
            'icon' => 'newwin'];
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function check()
    {
        return tep_db_num_rows(tep_db_query("SELECT configuration_value FROM configuration WHERE configuration_key = 'OSCOM_APP_PAYPAL_BRAINTREE_CC_STATUS'"));
    }

    public function install(): void
    {
        tep_redirect(tep_href_link('braintree.php', 'action=configure'));
    }

    public function remove(): void
    {
        tep_redirect(tep_href_link('braintree.php', 'action=configure'));
    }

    public function keys()
    {
        return ['MODULE_CONTENT_ACCOUNT_BRAINTREE_CARDS_SORT_ORDER'];
    }
}
