<?
exit;
if ($editmode=='newproducts') {
if ($products_status_new!=1) $products_status_new = 0; //else $products_status_new = 0;

//insert
    tep_db_query("INSERT into products (products_status,        manufacturers_id, products_hp_trvale,        products_date_added, products_last_modified) 
    values                             ('$products_status_new', 1,                '$products_hp_trvale_new', NOW(),               NOW())");
    $idzaznamu=mysql_insert_id();
    tep_db_query("insert into products_to_categories (products_id, categories_id) values ('$idzaznamu', '$novakateg')");
    tep_db_query("insert into products_description (products_name, products_description, products_url, products_id, language_id)
    values ('$products_name_new',       '$products_description_new',        '',     '$idzaznamu', '7')");
} 

if ($editmode=='editproducts') {
//update
if ($products_status!=1) $products_status = 0; //else $products_status_new = 0;
    tep_db_query('UPDATE products_description SET products_description="' . $products_description . '" WHERE products_id=' . (int)$_GET['products_id'] . ' AND language_id=' . $languages_id);
    tep_db_query("UPDATE products SET products_status='$products_status ' WHERE products_id=" . $_GET['products_id']);

}
echo '
<script language="javascript">
<!--
document.write(history.go(-1));
//-->
</script>';
?>