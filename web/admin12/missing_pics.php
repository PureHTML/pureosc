<?php
/*
  missing_pics.php,v 2.0 2006/11/17 22:05:52

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Idea by FaustinoInc.com

  Rewritten by Brian Burton (dynamoeffects)
  
  Released under the GNU General Public License
*/
  require('includes/application_top.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css" />
<script type="text/javascript" src="includes/general.js"></script>
</head>
<body onload="SetFocus();">
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
        <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
      </tr>
<?php
  //Change this line if you keep your images stored in a strange directory.
  //Don't touch it unless you're having problems.
  $image_directory = DIR_FS_CATALOG . DIR_WS_IMAGES;

  $image_columns = array('products_image');
  
  $column_query_string = '';
  $image_count = 0;
  
  foreach ($image_columns as $column) {
    if ($column_query_string != '') $column_query_string .= ', ';
    $column_query_string .= $column;
  }
  
  $image_array = array();
  $images_query = tep_db_query("SELECT products_id, " . $column_query_string . " FROM " . TABLE_PRODUCTS);
  
  while ($row = tep_db_fetch_array($images_query)) {
    $image_array[$row['products_id']] = array();
    
    foreach ($image_columns as $column) {
      if ($row[$column] != '') {
        $image_array[$row['products_id']][] = $row[$column];
        $image_count++;
      }
    }
  }
  
  /* Our image array is now built, start checking files. */
  $missing_images = array();
  
  foreach ($image_array as $id => $product) {
    foreach ($product as $image) {
      if (! is_file($image_directory . $image)){
        if (!is_array($missing_images[$id])) $missing_images[$id] = array();
        
        $missing_images[$id][] = $image;
      }
    }
  }
?>
      <tr>
        <td class="main">
<?php  if (count($missing_images) > 0) { ?>
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr class="dataTableHeadingRow">
                  <td class="dataTableHeadingContent" align="center" width="30"><?php echo TABLE_HEADING_PRODUCT_ID; ?></td>
                  <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_NAME; ?></td>
                  <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_IMAGES; ?></td>
                </tr>
<?php
      foreach ($missing_images as $id => $files) { 
        $product_query = tep_db_query("SELECT products_name FROM " . TABLE_PRODUCTS_DESCRIPTION . " WHERE products_id = '" . (int)$id . "' AND language_id = '" . ($language_id > 0 ? (int)$language_id : '1') . "'");
        $product = tep_db_fetch_array($product_query);
?>
                <tr>
                  <td class="dataTableContent" align="center" width="30"><?php echo $id; ?></td>
                  <td class="dataTableContent"><a href="<?php echo tep_href_link(FILENAME_CATEGORIES, 'pID=' . $id . '&amp;action=new_product') . '">' . $product['products_name']; ?></a></td>
                  <td class="dataTableContent">
<?php     
        foreach ($files as $f) {
          echo $f . '<br />';
        }
?>
                  </td>
                </tr>
                <tr>
                  <td colspan="3" style="padding: 0px; height: 1px; font-size: 1px; background-color: #EFEFEF"></td>
                </tr>
<?php
      }
?>

              </table></td>
            </tr>
          </table>
<?php
    } else { ?>
          <table border="0" width="100%">
            <tr>
              <td class="main" valign="middle" align="center"> <?php echo CONGRATULATION_1 . $image_count . CONGRATULATION_2 ; ?> </td>
            </tr>
          </table>
<?php  } ?>
        </td>

    
    
<?php // inizio per articoli senza fotografia

  $images_query_2 = tep_db_query("SELECT products_id, products_model FROM " . TABLE_PRODUCTS . " WHERE products_image IS NULL" ); 
  $product_2 = tep_db_fetch_array($images_query_2);
    if (count($product_2) > 1) { 
?>
      <tr>
        <td class="main">
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr class="dataTableHeadingRow">
                  <td class="dataTableHeadingContent" align="center" width="30"><?php echo TABLE_HEADING_PRODUCT_ID; ?></td>
                  <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_NAME; ?></td>
                  <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_IMAGES_2; ?></td>
                </tr>
                <tr>
                  <td class="dataTableContent" align="center" width="30"><?php echo $product_2['products_id']; ?></td>
                  <td class="dataTableContent"><a href="<?php echo tep_href_link(FILENAME_CATEGORIES, 'pID=' . $product_2['products_id']. '&amp;action=new_product') . '">' . $product_2['products_model']; ?></a></td>
                  <td class="dataTableContent"> &nbsp; </td>
                </tr>
                <tr>
                  <td colspan="3" style="padding: 0px; height: 1px; font-size: 1px; background-color: #EFEFEF"></td>
                </tr>
              </table></td>
            </tr>
          </table>

<?php } else { ?>
          <table border="0" width="100%">
            <tr>
              <td class="main" valign="middle" align="center"> <?php echo CONGRATULATION_3 . $image_count . CONGRATULATION_4 ; ?> </td>
            </tr>
          </table>
<?php } ?>
        </td>
      </tr>
<?php
// fine controllo articoli senza immagine
?>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>