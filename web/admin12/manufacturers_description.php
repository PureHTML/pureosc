<?
//include "pripojdtb.php";
require('includes/application_top.php');
//$jaz = 1;


		if (($vstup==1))
		{


		mysql_query("UPDATE manufacturers SET manufacturers_description_czech='$kod' WHERE manufacturers_id=$id");



//		print "<html> <body ONLOAD=self.close()> </body> </html>";
		echo '<script language="javascript"><!--
		document.write(history.go(-2));
		//--></script>';
		exit;
		}


			$res=mysql_query("SELECT * FROM manufacturers  WHERE manufacturers_id=$id");
			$num=mysql_num_rows($res);
			if ($num==0) exit;
			$row=mysql_fetch_array($res);
			$kod=$row["manufacturers_description_czech"];
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