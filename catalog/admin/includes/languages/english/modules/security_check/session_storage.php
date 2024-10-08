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

\define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'The sessions directory does not exist: '.tep_session_save_path().'. Sessions will not work until this directory is created.');
\define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'I am not able to write to the sessions directory: '.tep_session_save_path().'. Sessions will not work until the right user permissions are set.');
