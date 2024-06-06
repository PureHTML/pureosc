<?
include "pripojdtb.php";


		if (($vstup==1))
		{


		mysql_query("UPDATE products SET products_description_long_order='$neworder' WHERE products_id=$id");

                echo '<script language="javascript"><!--
		document.write(history.go(-2));
		//--></script>';
		exit;
										}


			$res=mysql_query("SELECT products_description_long_order FROM products WHERE products_id=$id");
			$num=mysql_num_rows($res);
			if ($num==0) exit;
			$row=mysql_fetch_array($res);
			$products_description_long_order=$row["products_description_long_order"];
			mysql_free_result($res);

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
</head>
<html>
<body>
zadejte poradove cislo vetsi nez nula nejlepe cislovat 10, 20, 30, 40, 50 aby se dalo pridavat mezi desitky<br>
<form action="?id=<? print $id;  ?>&vstup=1" method="post" enctype="multipart/form-data">

	<input name=neworder type=text  value="<? print $products_description_long_order; ?>">
	  </form>
	

</html>