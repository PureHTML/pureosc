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
 *
 * @param mixed $to
 * @param mixed $from
 */
function quote_ecb_s1_currency($to, $from = DEFAULT_CURRENCY)
{
    static $data;
    $rate = 1;

    if ($to === $from) {
        return $rate;
    }

    if (empty($data)) {
        $data = json_decode(file_get_contents('https://api.exchangeratesapi.io/latest?base='.$from), true);
    }

    if (!empty($data)) {
        return isset($data['rates'][$to]) ? (string) $data['rates'][$to] : '';
    }

    return $rate;
}

function quote_ecb_s2_currency($to, $from = DEFAULT_CURRENCY)
{
    static $data;
    $rate = 1;

    if ($to === $from) {
        return $rate;
    }

    if (empty($data)) {
        $data = json_decode(file_get_contents('https://api.exchangerate.host/latest?base='.$from), true);
    }

    if (!empty($data) && $data['success'] === true) {
        return isset($data['rates'][$to]) ? (string) $data['rates'][$to] : '';
    }

    return $rate;
}
