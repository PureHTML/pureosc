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

// Pouzivani bez souhlasu autora neni povoleno
// #Ver:PRV089-22-g45d1515b:2021-09-02#

interface IDatabaseConnection
{
    public function sqlQuery($sql);
    public function sqlExecute($sql);
    public function getInsertId();
}

class MysqliConnection implements IDatabaseConnection
{
    protected $mysqli;

    public function __construct($server, $login, $password, $dbname)
    {
        if (preg_match('/^(.*):([0-9]+)$/', $server, $matches)) {
            $host = $matches[1];
            $port = $matches[2];
            $this->mysqli = new mysqli($host, $login, $password, $dbname, $port);
        } elseif (preg_match('#^.*:(/.*)$#', $server, $matches)) {
            $socket = $matches[1];
            $this->mysqli = new mysqli('', $login, $password, $dbname, \ini_get('mysqli.default_port'), $socket);
        } elseif (preg_match('#^(/.*)$#', $server, $matches)) {
            $socket = $matches[1];
            $this->mysqli = new mysqli('', $login, $password, $dbname, \ini_get('mysqli.default_port'), $socket);
        } else {
            $this->mysqli = new mysqli($server, $login, $password, $dbname);
        }

        $this->mysqli->set_charset('utf8');
        $GLOBALS['DatabaseConnection_toSql_object'] = $this;
    }

    public function sqlQuery($sql)
    {
        $res = $this->mysqli->query($sql);

        if (!$res) {
            trigger_error("Query Failed! SQL: {$sql} - Error: ".$this->mysqli->error);
        }

        $ar = [];

        while ($row = $res->fetch_array()) {
            $ar[] = $row;
        }

        $res->free();

        return $ar;
    }

    public function sqlExecute($sql): void
    {
        $res = $this->mysqli->query($sql);

        if (!$res) {
            trigger_error("Query Failed! SQL: {$sql} - Error: ".$this->mysqli->error);
        }

        if ($res instanceof mysqli_result) {
            $res->free();
        }
    }

    public function getInsertId()
    {
        return $this->mysqli->insert_id;
    }

    public function toSql($text)
    {
        if (null === $text) {
            return 'null';
        }

        return "'".$this->mysqli->real_escape_string($text)."'";
    }
}

class MysqliConnectionShared extends MysqliConnection
{
    public function __construct($server, $login, $password, $dbname)
    {
        global $MysqliConnectionShared_mysqli;

        if ($MysqliConnectionShared_mysqli !== null) {
            $this->mysqli = $MysqliConnectionShared_mysqli;
        } else {
            parent::__construct($server, $login, $password, $dbname);
            $MysqliConnectionShared_mysqli = $this->mysqli;
        }
    }
}

class MysqlConnection implements IDatabaseConnection
{
    protected $dbconn;

    public function __construct($server, $login, $password, $dbname)
    {
        $this->dbconn = mysql_connect($server, $login, $password);
        mysql_select_db($dbname) || trigger_error('Chyba databaze: '.mysql_error());
        mysql_query("SET NAMES 'UTF-8'");
        $GLOBALS['DatabaseConnection_toSql_object'] = $this;
    }

    public function sqlQuery($sql)
    {
        $res = $this->sqlExecute($sql);

        $ar = [];

        while ($row = mysql_fetch_array($res)) {
            $ar[] = $row;
        }

        return $ar;
    }

    public function sqlExecute($sql)
    {
        return mysql_query($sql) || trigger_error(mysql_error().'<br/>SQL: '.$sql, \E_USER_ERROR);
    }

    public function getInsertId()
    {
        return mysql_insert_id();
    }

    public function toSql($text)
    {
        if (null === $text) {
            return 'null';
        }

        return "'".mysql_real_escape_string($text)."'";
    }
}

if (!\function_exists('toSql')) {
    function toSql($text)
    {
        return $GLOBALS['DatabaseConnection_toSql_object']->toSql($text);
    }
}
