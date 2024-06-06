<?
include "pripojdtb.php";
//$jaz = 1;


		if (($vstup==1))
		{


		mysql_query("UPDATE products_description SET products_description='$kod' WHERE products_id=$id AND language_id=$jaz");



//		print "<html> <body ONLOAD=self.close()> </body> </html>";
		echo '<script language="javascript"><!--
		document.write(history.go(-2));
		//--></script>';
		exit;
		}


			$res=mysql_query("SELECT * FROM products_description WHERE products_id=$id AND language_id=$jaz");
			$num=mysql_num_rows($res);
			if ($num==0) exit;
			$row=mysql_fetch_array($res);
			$kod=$row["products_description"];
			mysql_free_result($res);

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript" src="/fckeditor/fckeditor.js"></script>
<script type="text/javascript">
  window.onload = function()
    {
    var oFCKeditor = new FCKeditor( 'kod' ) ;
    oFCKeditor.ReplaceTextarea() ;
  }
 </script>																								

</head>
<html>
<body>

<form action="?id=<? print $id;  ?>&jaz=<? print $jaz; ?>&vstup=1" method="post" enctype="multipart/form-data">
<label accesskey="S" for="s">ALT+S - Uloit a odejít</labe>
<input name=s id=s type=submit value="S">
	<textarea name="kod" id="kod"><? print $kod; ?></textarea>

</html>