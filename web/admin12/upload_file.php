<?php
  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/' . 'upload_file.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>"/>
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css"/>
<script type="text/javascript" src="includes/general.js"></script>
</head>
<body> 
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td>
<?php
error_reporting(2047);
if (isset($_POST["invio"])) {
  $percorso = "../free_download/";
  if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
    if (move_uploaded_file($_FILES['file1']['tmp_name'], $percorso.$_FILES['file1']['name'])) {
      echo UPLOAD_FILE . ' <b>'.$_FILES['file1']['name'].'</b><br />';
      echo UPLOAD_MIME . ' <b>'.$_FILES['file1']['type'].'</b><br />';
      echo UPLOAD_DIMENSION . ' <b>'.$_FILES['file1']['size'].'</b> byte<br />';
      echo '======================<br />';
      echo UPLOAD_SUCCES . '<br /><br />';
      echo '<a href="upload_file.php">' . UPLOAD_NEWS . '</a>';
    } else {
      echo UPLOAD_ERROR . $_FILES["file1"]["error"];
    }
  } else {
    echo UPLOAD_ERROR_2 . $_FILES["file1"]["error"];
  }
} else {
  // HTML ?>
    <form enctype="multipart/form-data" method="post" action="" name="uploadform">
      <?php echo UPLOAD_NAME_FILE ; ?> -> ../free_download/
      <br />
      <input type="file" name="file1" size="50" />
      <br />
      <input type="submit" value="invia" name="invio" />
    </form>
  <?php
}
?>
        </td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
