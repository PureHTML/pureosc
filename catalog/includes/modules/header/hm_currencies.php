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
class hm_currencies
{
    public $code;
    public $group = 'header';
    public $title;
    public $description;
    public $sort_order;
    public $enabled = false;

    public function __construct()
    {
        $this->code = \get_class($this);
        $this->group = basename(__DIR__);

        $this->title = MODULE_HEADER_CURRENCIES_TITLE;
        $this->description = MODULE_HEADER_CURRENCIES_DESCRIPTION;

        if (\defined('MODULE_HEADER_CURRENCIES_STATUS')) {
            $this->sort_order = MODULE_HEADER_CURRENCIES_SORT_ORDER;
            $this->enabled = (MODULE_HEADER_CURRENCIES_STATUS === 'True');
        }
    }

    public function execute(): void
    {
        global $oscTemplate, $PHP_SELF, $currencies, $request_type, $currency, $oscTemplate;

        $currencies_array = [];

        foreach ($currencies->currencies as $key => $value) {
            $currencies_array[] = ['id' => $key, 'text' => $value['title']];
        }

        $hidden_get_variables = '';

        foreach ($_GET as $key => $value) {
            if (\is_string($value) && ($key !== 'currency') && ($key !== tep_session_name()) && ($key !== 'x') && ($key !== 'y')) {
                $hidden_get_variables .= tep_draw_hidden_field($key, $value);
            }
        }

        ob_start();

        include 'includes/modules/'.$this->group.'/templates/currencies.php';

        $oscTemplate->addBlock(ob_get_clean(), 'header_top');
    }

    public function isEnabled()
    {
        global $PHP_SELF, $currencies;

        if (substr(basename($PHP_SELF), 0, 8) !== 'checkout' && (isset($currencies) && \is_object($currencies) && (\count($currencies->currencies) > 1))) {
            return $this->enabled;
        }

        return false;
    }

    public function check()
    {
        return \defined('MODULE_HEADER_CURRENCIES_STATUS');
    }

    public function install(): void
    {
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Module', 'MODULE_HEADER_CURRENCIES_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort Order', 'MODULE_HEADER_CURRENCIES_SORT_ORDER', '10', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_HEADER_CURRENCIES_STATUS', 'MODULE_HEADER_CURRENCIES_SORT_ORDER'];
    }
}
