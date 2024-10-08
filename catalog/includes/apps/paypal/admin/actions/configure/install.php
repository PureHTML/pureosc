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

$OSCOM_PayPal->install($current_module);

$OSCOM_PayPal->addAlert($OSCOM_PayPal->getDef('alert_module_install_success'), 'success');

tep_redirect(tep_href_link('paypal.php', 'action=configure&module='.$current_module));
