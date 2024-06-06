<?
if (ADMIN_LOGIN==1) include 'jsp/id_admin.php';
?>

<!-- levy nejsirsi //-->
<div style="text-align:left;width:95%">
<?
//HP text
$hpq = tep_db_query("select distinct p.products_id, p.products_last_modified, pd.products_name, pd.products_description, p.products_image from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' AND p.products_id=1673");
    while ($hp = tep_db_fetch_array($hpq)) {
echo '<h1>' . $hp['products_name'] . '</h1>';
if ($hp['products_image']!='') echo '<img align="left" src="images/' . $hp['products_image'] . '" class="hpnewsimage">';
echo $hp['products_description'];
}
/*
echo '<h2>' . HP_AKTUALITY  . '</h2>';

//$hpq = tep_db_query("SELECT pd.products_name");
$hpq = tep_db_query("select distinct p.products_id, p.products_last_modified, pd.products_name, pd.products_description, p.products_image from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where p.products_status = '1' and c.categories_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id AND p.products_hp_trvale=1 order by p.products_last_modified desc limit 3");
    while ($hp = tep_db_fetch_array($hpq)) {
echo '<h2><a class="nh2" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $hp['products_id']) . '">' . $hp['products_name'] . '</a></h2><br />';
if ($hp['products_image']!='') echo '<img align="left" src="images/' . $hp['products_image'] . '" class="hpnewsimage">';
echo tep_flatten_product_description_hp($hp['products_description'], ' <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $hp['products_id']) . '">' . TEXT_MORE . '</a>&nbsp;<div class="spodlinka">&nbsp; </div><br />');
}
*/
?>



</div>


<?php

 ?>
<?php //include(DIR_WS_MODULES . FILENAME_NEW_PRODUCTS);
?>

