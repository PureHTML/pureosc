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

\define('HEADING_TITLE', 'Define Languages');

\define('TABLE_HEADING_FILES', 'Files');
\define('TABLE_HEADING_WRITABLE', 'Writable');
\define('TABLE_HEADING_LAST_MODIFIED', 'Last Modified');

\define('TEXT_EDIT_NOTE', '<strong>Editing Definitions</strong><br /><br />Each language definition is set using the PHP <a href="http://www.php.net/define" target="_blank">define()</a> function in the following manner:<br /><br /><nobr>define(\'TEXT_MAIN\', \'<span style="background-color: #FFFF99;">This text can be edited. It\\\'s really easy to do!</span>\');</nobr><br /><br />The highlighted text can be edited. As this definition is using single quotes to contain the text, any single quotes within the text definition must be escaped with a backslash (eg, It\\\'s).');

\define('TEXT_FILE_DOES_NOT_EXIST', 'File does not exist.');

\define('ERROR_FILE_NOT_WRITEABLE', 'Error: I can not write to this file. Please set the right user permissions on: %s');
