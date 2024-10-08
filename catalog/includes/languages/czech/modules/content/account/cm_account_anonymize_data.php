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

\define('MODULE_CONTENT_ACCOUNT_ANONYMIZE_DATA_TITLE', 'Anonymize Data');
\define('MODULE_CONTENT_ACCOUNT_ANONYMIZE_DATA_DESCRIPTION', 'Show the anonymize data link on the account page');
\define('MODULE_CONTENT_ACCOUNT_ANONYMIZE_DATA_LINK_TITLE', 'Anonymize my personal data');

\define('MODULE_CONTENT_ACCOUNT_ANONYMIZE_DATA_NAVBAR_TITLE_1', 'My Account');
\define('MODULE_CONTENT_ACCOUNT_ANONYMIZE_DATA_NAVBAR_TITLE_2', 'Anonymize My Personal Data');
\define('MODULE_CONTENT_ACCOUNT_ANONYMIZE_DATA_HEADING_TITLE', 'Anonymize My Personal Data');

\define('MODULE_CONTENT_ACCOUNT_ANONYMIZE_DATA_TEXT_NO_ANONYMIZE_LINK_FOUND', 'Error: The anonymize data link was not found in our records, please try again by generating a new link.');
\define('MODULE_CONTENT_ACCOUNT_ANONYMIZE_DATA_TEXT_INITIATED', 'Please check your registered email address to confirm and anonymize your personal data.');

\define('MODULE_CONTENT_ACCOUNT_ANONYMIZE_DATA_TEXT_INFORMATION', 'Anonymizing your personal data means that it will be replaced with non-personal anonymous information and before that you will get your new login to your e-mail address (your password will stay the same).<br />After this process, your e-mail address and all other personal data will be removed from the store.');
\define('MODULE_CONTENT_ACCOUNT_ANONYMIZE_DATA_TEXT_CONSENT', 'I agree and i want to proceed');

\define('MODULE_CONTENT_ACCOUNT_ANONYMIZE_DATA_EMAIL_SUBJECT', 'Anonymize personal data request confirmation from'.STORE_NAME);
\define('MODULE_CONTENT_ACCOUNT_ANONYMIZE_DATA_EMAIL_BODY', "Hello %s,\n\n".'You\'ve received this email because we\'ve have been notified to anonymize your personal data in '.STORE_NAME."\n\nNew E-mail Address: %s\nPassword: will stay the same\n\nI understand this and confirm to anonymize my personal data, please follow this link\n\n%s");
\define('MODULE_CONTENT_ACCOUNT_ANONYMIZE_DATA_TEXT_SUCCESS_ACCOUNT_DELETE', 'Your personal data was successfully anonymized!');

\define('MODULE_CONTENT_ACCOUNT_ANONYMIZE_DATA_ANONYMIZE', 'Anonymize');
