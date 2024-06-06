#!/usr/bin/php -q
<?
//jsp:newscript:php_cli restore mysql
require("includes/configure.php");
exec ('mysql  -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p' . DB_SERVER_PASSWORD . ' ' . DB_DATABASE . '<admin/backups/lastcli.sql');
?>