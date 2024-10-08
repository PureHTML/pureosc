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

\define('HEADING_TITLE', 'Definir Idiomas');

\define('TABLE_HEADING_FILES', 'Archivos');
\define('TABLE_HEADING_WRITABLE', 'Modificable');
\define('TABLE_HEADING_LAST_MODIFIED', 'Ultima Modificación');

\define('TEXT_EDIT_NOTE', '<strong>Editando Definiciones</strong><br /><br />Cada definición de idioma es asignado utilizando la función PHP <a href="http://www.php.net/define" target="_blank">define()</a>de la siguiente manera:<br /><br /><nobr>define(\'TEXT_MAIN\', \'<span style="background-color: #FFFF99;">Este texto puede ser editado. Esto es realmente fácil de hacer!</span>\');</nobr><br /><br />El texto remarcado puede ser editado. Esta definición está utilizando comillas simples para contener el texto, cualquier comilla simple en la definición del texto debe ser asignado con el caracter escape backslash.');

\define('TEXT_FILE_DOES_NOT_EXIST', 'No existe fichero.');

\define('ERROR_FILE_NOT_WRITEABLE', 'Error: No puedo escribir sobre este fichero. Asigne correctamente los permisos a: %s');
