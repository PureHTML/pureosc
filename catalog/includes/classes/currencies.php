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
// Class to handle currencies
// TABLES: currencies
class currencies
{
    public $currencies;

    // class constructor
    public function __construct()
    {
        $this->currencies = [];
        $currencies_query = tep_db_query('select code, title, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, value from currencies');

        while ($currencies = tep_db_fetch_array($currencies_query)) {
            $this->currencies[$currencies['code']] = ['title' => $currencies['title'],
                'symbol_left' => $currencies['symbol_left'],
                'symbol_right' => $currencies['symbol_right'],
                'decimal_point' => $currencies['decimal_point'],
                'thousands_point' => $currencies['thousands_point'],
                'decimal_places' => (int) $currencies['decimal_places'],
                'value' => $currencies['value']];
        }
    }

    // class methods
    public function format($number, $calculate_currency_value = true, $currency_type = '', $currency_value = '')
    {
        global $currency;

        if (empty($currency_type)) {
            $currency_type = $currency;
        }

        if ($calculate_currency_value === true) {
            $rate = (!empty($currency_value)) ? $currency_value : $this->currencies[$currency_type]['value'];
            $format_string = $this->currencies[$currency_type]['symbol_left'].number_format(tep_round($number * $rate, $this->currencies[$currency_type]['decimal_places']), $this->currencies[$currency_type]['decimal_places'], $this->currencies[$currency_type]['decimal_point'], $this->currencies[$currency_type]['thousands_point']).$this->currencies[$currency_type]['symbol_right'];
        } else {
            $format_string = $this->currencies[$currency_type]['symbol_left'].number_format(tep_round($number, $this->currencies[$currency_type]['decimal_places']), $this->currencies[$currency_type]['decimal_places'], $this->currencies[$currency_type]['decimal_point'], $this->currencies[$currency_type]['thousands_point']).$this->currencies[$currency_type]['symbol_right'];
        }

        return $format_string;
    }

    public function calculate_price($products_price, $products_tax, $quantity = 1)
    {
        global $currency;

        return tep_round(tep_add_tax($products_price, $products_tax), $this->currencies[$currency]['decimal_places']) * $quantity;
    }

    public function is_set($code)
    {
        if (isset($this->currencies[$code]) && !empty($this->currencies[$code])) {
            return true;
        }

        return false;
    }

    public function get_value($code)
    {
        return $this->currencies[$code]['value'];
    }

    public function get_decimal_places($code)
    {
        return $this->currencies[$code]['decimal_places'];
    }

    public function display_price($products_price, $products_tax, $quantity = 1)
    {
        return $this->format($this->calculate_price($products_price, $products_tax, $quantity));
    }
}
