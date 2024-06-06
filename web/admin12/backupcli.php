#!/usr/bin/php -q
<?
//jsp:newscript:backup MySQL
	require("includes/configure.php");
$ddate = date('Y-m-d-H:i:s');
exec ('mysqldump --opt -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p' . DB_SERVER_PASSWORD . ' ' . DB_DATABASE . '>admin/backups/' . DB_DATABASE . '-'  . $ddate . 'cli.sql');
exec ('cp admin/backups/' . DB_DATABASE . '-'  . $ddate . 'cli.sql admin/backups/lastcli.sql');
//exec  $com;
//echo ('mysqldump -p'. DB_SERVER_PASSWORD .' -uroot --opt mvcr > /home/jeansolpartre/WWW/www.jeansolpartre.com/mvcr/backup/`date  +%d-%m-%Y_%H-%M-%S`.sql');

?>