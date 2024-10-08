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

\define('NAVBAR_TITLE', 'Create an Account');

\define('HEADING_TITLE', 'My Account Information');

\define('TEXT_ORIGIN_LOGIN', 'NOTE: If you already have an account with us, please login at the <a href="%s"><u>login page</u></a>.');

\define('EMAIL_SUBJECT', 'Welcome to '.STORE_NAME);
\define('EMAIL_GREET_MR', "Dear Mr. %s,\n\n");
\define('EMAIL_GREET_MS', "Dear Ms. %s,\n\n");
\define('EMAIL_GREET_NONE', "Dear %s\n\n");
\define('EMAIL_WELCOME', 'We welcome you to <strong>'.STORE_NAME."</strong>.\n\n");
\define('EMAIL_TEXT', "You can now take part in the <strong>various services</strong> we have to offer you. Some of these services include:\n\n<li><strong>Permanent Cart</strong> - Any products added to your online cart remain there until you remove them, or check them out.\n<li><strong>Address Book</strong> - We can now deliver your products to another address other than yours! This is perfect to send birthday gifts direct to the birthday-person themselves.\n<li><strong>Order History</strong> - View your history of purchases that you have made with us.\n<li><strong>Products Reviews</strong> - Share your opinions on products with our other customers.\n\n");
\define('EMAIL_CONTACT', 'For help with any of our online services, please email the store-owner: '.STORE_OWNER_EMAIL_ADDRESS.".\n\n");
\define('EMAIL_WARNING', '<strong>Note:</strong> This email address was given to us by one of our customers. If you did not signup to be a member, please send an email to '.STORE_OWNER_EMAIL_ADDRESS.".\n");
