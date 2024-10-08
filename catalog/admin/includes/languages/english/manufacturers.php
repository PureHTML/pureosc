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

\define('HEADING_TITLE', 'Manufacturers');

\define('TABLE_HEADING_MANUFACTURERS', 'Manufacturers');
\define('TABLE_HEADING_ACTION', 'Action');

\define('TEXT_HEADING_NEW_MANUFACTURER', 'New Manufacturer');
\define('TEXT_HEADING_EDIT_MANUFACTURER', 'Edit Manufacturer');
\define('TEXT_HEADING_DELETE_MANUFACTURER', 'Delete Manufacturer');

\define('TEXT_MANUFACTURERS', 'Manufacturers:');
\define('TEXT_DATE_ADDED', 'Date Added:');
\define('TEXT_LAST_MODIFIED', 'Last Modified:');
\define('TEXT_PRODUCTS', 'Products:');

\define('TEXT_NEW_INTRO', 'Please fill out the following information for the new manufacturer');
\define('TEXT_EDIT_INTRO', 'Please make any necessary changes');

\define('TEXT_MANUFACTURERS_NAME', 'Manufacturers Name:');
\define('TEXT_MANUFACTURERS_IMAGE', 'Manufacturers Image:');
\define('TEXT_MANUFACTURERS_URL', 'Manufacturers URL:');

\define('TEXT_DELETE_INTRO', 'Are you sure you want to delete this manufacturer?');
\define('TEXT_DELETE_IMAGE', 'Delete manufacturers image?');
\define('TEXT_DELETE_PRODUCTS', 'Delete products from this manufacturer? (including product reviews, products on special, upcoming products)');
\define('TEXT_DELETE_WARNING_PRODUCTS', '<strong>WARNING:</strong> There are %s products still linked to this manufacturer!');

\define('ERROR_DIRECTORY_NOT_WRITEABLE', 'Error: I can not write to this directory. Please set the right user permissions on: %s');
\define('ERROR_DIRECTORY_DOES_NOT_EXIST', 'Error: Directory does not exist: %s');
