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

\define('HEADING_TITLE', 'Administrator Login');

\define('TEXT_USERNAME', 'Username:');
\define('TEXT_PASSWORD', 'Password:');

\define('TEXT_CREATE_FIRST_ADMINISTRATOR', 'No administrators exist in the database table. Please fill in the following information to create the first administrator. (A manual login is still required after this step)');

\define('ERROR_INVALID_ADMINISTRATOR', 'Error: Invalid administrator login attempt.');

\define('BUTTON_LOGIN', 'Login');
\define('BUTTON_CREATE_ADMINISTRATOR', 'Create Administrator');

\define('ERROR_ACTION_RECORDER', 'Error: The maximum number of login attempts has been reached. Please try again in %s minutes.');
