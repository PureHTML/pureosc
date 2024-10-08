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

\define('NAVBAR_TITLE_1', 'Login');
\define('NAVBAR_TITLE_2', 'Password Forgotten');

\define('HEADING_TITLE', 'I\'ve Forgotten My Password!');

\define('TEXT_MAIN', 'If you\'ve forgotten your password, enter your e-mail address below and we\'ll send you instructions on how to securely change your password.');

\define('TEXT_PASSWORD_RESET_INITIATED', 'Please check your e-mail for instructions on how to change your password. The instructions contain a link that is valid only for 24 hours or until your password has been updated.');

\define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Error: The E-Mail Address was not found in our records, please try again.');

\define('EMAIL_PASSWORD_RESET_SUBJECT', STORE_NAME.' - New Password');
\define('EMAIL_PASSWORD_RESET_BODY', 'A new password has been requested for your account at '.STORE_NAME.".\n\nPlease follow this personal link to securely change your password:\n\n%s\n\nThis link will be automatically discarded after 24 hours or after your password has been changed.\n\nFor help with any of our online services, please email the store-owner: ".STORE_OWNER_EMAIL_ADDRESS.".\n\n");

\define('ERROR_ACTION_RECORDER', 'Error: A password reset link has already been sent. Please try again in %s minutes.');
