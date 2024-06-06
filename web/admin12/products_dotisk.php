<?
include "pripojdtb.php";
if ($dotisk == 1) $dotisk = date(U); 
else $dotisk = '0';

		mysql_query("UPDATE products SET products_dotisk='$dotisk' WHERE products_id=$id");
                echo '<script language="javascript"><!--
		document.write(history.go(-1));
		//--></script>';
		exit;
