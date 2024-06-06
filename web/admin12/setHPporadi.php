<?
include "pripojdtb.php";


		if (($vstup==1))
		{


		mysql_query("UPDATE products SET products_hp_poradi='$newporadi' WHERE products_id=$id");



		print "<html> <body ONLOAD=self.close()> </body> </html>";

		exit;
		}


			$res=mysql_query("SELECT products_hp_poradi FROM products WHERE products_id=$id");
			$num=mysql_num_rows($res);
			if ($num==0) exit;
			$row=mysql_fetch_array($res);
			$products_hp_poradi=$row["products_hp_poradi"];
			mysql_free_result($res);

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
</head>
<html>
<body>

<form action="?id=<? print $id;  ?>&vstup=1" method="post" enctype="multipart/form-data">

	<input name=newporadi type=text  value="<? print $products_hp_poradi; ?>">
	  </form>
<br>
HELP: zapisuj primarne poradi 100, 200, 300 aby se dalo snadno menit tim, ze mezi cisla  vlozis dalsi clanky napr: 110, 120... a potom treba 111,112

</html>