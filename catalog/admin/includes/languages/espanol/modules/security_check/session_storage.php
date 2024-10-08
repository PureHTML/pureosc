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

\define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'El directorio de sesión no existe: '.tep_session_save_path().'. Las sesiones no funcionarán hasta que este directorio sea creado.');
\define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'No se puede escribir en el directorio de sesiones: '.tep_session_save_path().'. Las sesiones no se guardarán hasta que se establezcan los permisos.');
