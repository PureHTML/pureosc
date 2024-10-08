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

\define('MODULE_PAYMENT_MONEYORDER_TEXT_TITLE', 'Check/Money Order');
\define('MODULE_PAYMENT_MONEYORDER_TEXT_DESCRIPTION', 'Hacer pagadero a:&nbsp;'.(\defined('MODULE_PAYMENT_MONEYORDER_PAYTO') ? MODULE_PAYMENT_MONEYORDER_PAYTO : '').'<br /><br />Enviar A:<br />'.STORE_NAME.'<br />'.nl2br(STORE_NAME_ADDRESS).'<br /><br />Su pedido no se enviar&aacute; hasta que recibamos el pago.');
\define('MODULE_PAYMENT_MONEYORDER_TEXT_EMAIL_FOOTER', 'Hacer pagadero a: '.(\defined('MODULE_PAYMENT_MONEYORDER_PAYTO') ? MODULE_PAYMENT_MONEYORDER_PAYTO : '')."\n\nEnviar A:\n\n".STORE_NAME."\n".STORE_NAME_ADDRESS."\n\nSu pedido no se enviar&aacute; hasta que recibamos el pago.");
