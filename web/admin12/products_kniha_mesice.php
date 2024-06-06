<?
include "pripojdtb.php";



		mysql_query("UPDATE products SET products_kniha_mesice=0");
		mysql_query("UPDATE products SET products_kniha_mesice='$status' WHERE products_id=$id");

                echo '<script language="javascript"><!--
		document.write(history.go(-1));
		//--></script>';
		exit;
