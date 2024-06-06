<?
	require("includes/configure.php");
	mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
	mysql_query('SET NAMES UTF8');
	mysql_select_db(DB_DATABASE);
?>