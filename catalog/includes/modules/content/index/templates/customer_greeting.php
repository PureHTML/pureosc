<div class="col2">
<?php
  $info_query = tep_db_query("SELECT products_description FROM products_description WHERE products_name='Homepage' AND language_id=".$languages_id);
//  $info_query = tep_db_query("SELECT products_description FROM products, products_description WHERE products.products_id=products_description.products_id AND products_description.products_name='Homepage' AND language_id=" . $languages_id);
$info = tep_db_fetch_array($info_query);
echo \is_array($info) ? $info['products_description'] : '';
?>
</div>