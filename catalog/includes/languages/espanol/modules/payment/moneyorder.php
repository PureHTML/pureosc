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
\define('MODULE_PAYMENT_MONEYORDER_TEXT_DESCRIPTION', 'Hacer pagadero a:&nbsp;'.(\defined('MODULE_PAYMENT_MONEYORDER_PAYTO') ? MODULE_PAYMENT_MONEYORDER_PAYTO : '').'<br /><br />Enviar A:<br />'.STORE_NAME.'<br />'.nl2br(STORE_NAME_ADDRESS).'<br /><br />Su pedido no se enviar&aacute; hasta que recibamos el pago.');
\define('MODULE_PAYMENT_MONEYORDER_TEXT_EMAIL_FOOTER', 'Hacer pagadero a: '.(\defined('MODULE_PAYMENT_MONEYORDER_PAYTO') ? MODULE_PAYMENT_MONEYORDER_PAYTO : '')."\n\nEnviar A:\n\n".STORE_NAME."\n".STORE_NAME_ADDRESS."\n\nSu pedido no se enviar&aacute; hasta que recibamos el pago.");
