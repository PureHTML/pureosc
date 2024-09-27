<?php

declare(strict_types=1);

/**
 * This file is part of the DvereCOM package
 *
 *  (c) Šimon Formánek <mail@simonformanek.cz>
 * This file is part of the MultiFlexi package
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

\define('MODULE_PAYMENT_MONEYORDER_TEXT_TITLE', 'Check/Money Order');
\define('MODULE_PAYMENT_MONEYORDER_TEXT_DESCRIPTION', 'Make Payable To: '.(\defined('MODULE_PAYMENT_MONEYORDER_PAYTO') ? MODULE_PAYMENT_MONEYORDER_PAYTO : '').'<br /><br />Send To:<br />'.STORE_NAME.'<br />'.nl2br(STORE_NAME_ADDRESS).'<br /><br />Your order will not ship until we receive payment.');
\define('MODULE_PAYMENT_MONEYORDER_TEXT_EMAIL_FOOTER', 'Make Payable To: '.(\defined('MODULE_PAYMENT_MONEYORDER_PAYTO') ? MODULE_PAYMENT_MONEYORDER_PAYTO : '')."\n\nSend To:\n".STORE_NAME."\n".STORE_NAME_ADDRESS."\n\nYour order will not ship until we receive payment.");
