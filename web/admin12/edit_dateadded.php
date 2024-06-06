<?
//include "pripojdtb.php";
  require('includes/application_top.php');
if (($vstup==1)) {
mysql_query("UPDATE products SET products_date_added='$newdate' WHERE products_id=$id");
echo '<script language="javascript"><!--
document.write(history.go(-2));
//--></script>';
exit;
}
			$res=tep_db_query("SELECT products_date_added FROM products WHERE products_id=$id");
			$num=mysql_num_rows($res);
			if ($num==0) exit;
			$row=mysql_fetch_array($res);
			$products_date_added=$row["products_date_added"];
			$products_date_added =  substr($products_date_added,0,10);
			mysql_free_result($res);

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
</head>
<html>
<body>
format: (rrrr-mm-dd)
<form action="?id=<? print $id;  ?>&vstup=1" method="post" enctype="multipart/form-data">

	<input name=newdate type=text  value="<? print $products_date_added; ?>">
	  </form>
	

</html>