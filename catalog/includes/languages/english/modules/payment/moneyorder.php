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

\define('MODULE_PAYMENT_MONEYORDER_TEXT_TITLE', 'Check/Money Order');
\define('MODULE_PAYMENT_MONEYORDER_TEXT_DESCRIPTION', 'Make Payable To: '.(\defined('MODULE_PAYMENT_MONEYORDER_PAYTO') ? MODULE_PAYMENT_MONEYORDER_PAYTO : '').'<br /><br />Send To:<br />'.STORE_NAME.'<br />'.nl2br(STORE_NAME_ADDRESS).'<br /><br />Your order will not ship until we receive payment.');
\define('MODULE_PAYMENT_MONEYORDER_TEXT_EMAIL_FOOTER', 'Make Payable To: '.(\defined('MODULE_PAYMENT_MONEYORDER_PAYTO') ? MODULE_PAYMENT_MONEYORDER_PAYTO : '')."\n\nSend To:\n".STORE_NAME."\n".STORE_NAME_ADDRESS."\n\nYour order will not ship until we receive payment.");
