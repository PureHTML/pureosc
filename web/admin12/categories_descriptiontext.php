<?php
//jsp:newspec
  require('includes/application_top.php');
//  require('includes/functions/general.php');
$lang = $_GET['lang'];
$id = $_GET['id'];
/*
fullscreen wysiwyg editor for categories_description Copyright (c) 2008 shop2.0brain.com
*/
//include "pripojdtb.php";
		if (($_GET['edit'] == 1)) {
		$kod = $_POST['kod'];
//		$kod = msword_autoclean($_POST['kod']);
		tep_db_query("UPDATE categories_description SET categories_description='$kod' WHERE categories_id=$id AND language_id=$lang");

		echo '<script language="javascript"><!--
		document.write(history.go(-2));
		//--></script>';
		exit;
		}
	$res=tep_db_query("SELECT * FROM categories_description WHERE categories_id=$id AND language_id=$lang");
	$num=tep_db_num_rows($res);
	if ($num==0) exit;
	$row=tep_db_fetch_array($res);
	$kod=$row["categories_description"];
	tep_db_free_result($res);

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="/fckeditor/fckeditor.js"></script>
<script>
  window.onload = function()
    {
    var oFCKeditor = new FCKeditor( 'kod' ) ;
    oFCKeditor.ReplaceTextarea() ;
  }
 </script>																								

</head>
<html>
<body>
<form action="?id=<? print $id;  ?>&lang=<? print $lang; ?>&edit=1" method="post" enctype="multipart/form-data">
<textarea name="kod" id="kod"><? print $kod; ?></textarea>

</html>