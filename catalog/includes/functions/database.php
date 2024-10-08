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

/**
 * This file is part of the DvereCOM package.
 *
 *  (c) Šimon Formánek <mail@simonformanek.cz>
 * This file is part of the MultiFlexi package
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @param mixed $server
 * @param mixed $username
 * @param mixed $password
 * @param mixed $database
 * @param mixed $link
 */
function tep_db_connect($server = DB_SERVER, $username = DB_SERVER_USERNAME, $password = DB_SERVER_PASSWORD, $database = DB_DATABASE, $link = 'db_link')
{
    global ${$link};

    if (USE_PCONNECT === 'true') {
        $server = 'p:'.$server;
    }

    ${$link} = mysqli_connect($server, $username, $password, $database);

    if (!mysqli_connect_errno()) {
        mysqli_set_charset(${$link}, 'utf8mb4');
    }

    @mysqli_query(${$link}, 'set session sql_mode=""');

    return ${$link};
}

function tep_db_close($link = 'db_link')
{
    global ${$link};

    return mysqli_close(${$link});
}

function tep_db_error($query, $errno, $error): void
{
    if (\defined('STORE_DB_TRANSACTIONS') && (STORE_DB_TRANSACTIONS === 'true')) {
        error_log('ERROR: ['.$errno.'] '.$error."\n", 3, STORE_PAGE_PARSE_TIME_LOG);
    }

    exit('<font color="#000000"><strong>'.$errno.' - '.$error.'<br /><br />'.$query.'<br /><br /><small><font color="#ff0000">[TEP STOP]</font></small><br /><br /></strong></font>');
}

function tep_db_query($query, $link = 'db_link')
{
    global ${$link};

    if (\defined('STORE_DB_TRANSACTIONS') && (constant('STORE_DB_TRANSACTIONS') === 'true')) {
        error_log('QUERY: '.$query."\n", 3, STORE_PAGE_PARSE_TIME_LOG);
    }

    $result = mysqli_query(${$link}, $query);

    if (\is_bool($result) && $result === false) {
        $result = tep_db_error($query, mysqli_errno(${$link}), mysqli_error(${$link}));
    }

    return $result;
}

function tep_db_perform($table, $data, $action = 'insert', $parameters = '', $link = 'db_link')
{
    if ($action === 'insert') {
        $query = 'insert into '.$table.' (';

        foreach (array_keys($data) as $columns) {
            $query .= $columns.', ';
        }

        $query = substr($query, 0, -2).') values (';

        foreach ($data as $value) {
            switch ((string) $value) {
                case 'now()':
                    $query .= 'now(), ';

                    break;
                case 'null':
                    $query .= 'null, ';

                    break;

                default:
                    $query .= '\''.tep_db_input($value).'\', ';

                    break;
            }
        }

        $query = substr($query, 0, -2).')';
    } elseif ($action === 'update') {
        $query = 'update '.$table.' set ';

        foreach ($data as $columns => $value) {
            switch ((string) $value) {
                case 'now()':
                    $query .= $columns.' = now(), ';

                    break;
                case 'null':
                    $query .= $columns .= ' = null, ';

                    break;

                default:
                    $query .= $columns.' = \''.tep_db_input($value).'\', ';

                    break;
            }
        }

        $query = substr($query, 0, -2).' where '.$parameters;
    }

    return tep_db_query($query, $link);
}

function tep_db_fetch_array($db_query)
{
    return mysqli_fetch_array($db_query, \MYSQLI_ASSOC);
}

function tep_db_num_rows($db_query)
{
    return mysqli_num_rows($db_query);
}

function tep_db_data_seek($db_query, $row_number)
{
    return mysqli_data_seek($db_query, $row_number);
}

function tep_db_insert_id($link = 'db_link')
{
    global ${$link};

    return mysqli_insert_id(${$link});
}

function tep_db_free_result($db_query)
{
    return mysqli_free_result($db_query);
}

function tep_db_fetch_fields($db_query)
{
    return mysqli_fetch_field($db_query);
}

function tep_db_output($string)
{
    return htmlspecialchars($string);
}

function tep_db_input($string, $link = 'db_link')
{
    global ${$link};

    return mysqli_real_escape_string(${$link}, (string) $string);
}

function tep_db_prepare_input($string)
{
    if (\is_string($string)) {
        return trim(tep_sanitize_string(stripslashes($string)));
    }

    if (\is_array($string)) {
        foreach ($string as $key => $value) {
            $string[$key] = tep_db_prepare_input($value);
        }

        return $string;
    }

    return $string;
}

function tep_db_affected_rows($link = 'db_link')
{
    global ${$link};

    return mysqli_affected_rows(${$link});
}

function tep_db_get_server_info($link = 'db_link')
{
    global ${$link};

    return mysqli_get_server_info(${$link});
}
