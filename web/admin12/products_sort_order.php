<?
//include "pripojdtb.php";
  require('includes/application_top.php');



		if (($vstup==1))
		{


		mysql_query("UPDATE products SET products_listing_order='$newporadi' WHERE products_id=$id");
                echo '<script language="javascript"><!--
document.write(history.go(-2));
//--></script>';
exit;
}


			$res=mysql_query("SELECT products_listing_order FROM products WHERE products_id=$id");
			$num=mysql_num_rows($res);
			if ($num==0) exit;
			$row=mysql_fetch_array($res);
			$products_listing_order=$row["products_listing_order"];
			mysql_free_result($res);

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<html>
<body>

<form action="?id=<? print $id;  ?>&vstup=1" method="post" enctype="multipart/form-data">

	<input name=newporadi type=text  value="<? print $products_listing_order; ?>">
	  </form>
<br>
HELP: zapisuj primarne poradi 10, 20, 30 aby se dalo snadno menit tim, ze mezi cisla  vlozis dalsi clanky

</html>