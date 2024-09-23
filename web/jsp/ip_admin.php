<?
exit;
$articlearea = 600;
if ($editmode!='') {
if ($editmode=='newproducts') {
if ($products_status_new!=1) $products_status_new = 0; //else $products_status_new = 0;

//insert
    tep_db_query("INSERT into products (products_status, manufacturers_id, products_hp_trvale, products_date_added, products_last_modified) values ('$products_status_new', 1, '$products_hp_trvale_new', NOW(), NOW())");
    $idzaznamu=mysql_insert_id();
    tep_db_query("insert into products_to_categories (products_id, categories_id) values ('$idzaznamu', '$novakateg')");
    tep_db_query("insert into products_description (products_name, products_description, products_url, products_id, language_id)
    values ('$products_name_new',       '$products_description_new',        '',     '$idzaznamu', '7')");
} 

if ($editmode=='editcategory') {
//update
//if ($products_status!=1) $products_status = 0; //else $products_status_new = 0;
    tep_db_query('UPDATE categories_description SET categories_description="' . $categories_description . '" WHERE categories_id=' . (int)$current_category_id . ' AND language_id=' . $languages_id);
    tep_db_query('UPDATE categories_description SET categories_name="' . $categories_name . '" WHERE categories_id=' . (int)$current_category_id . ' AND language_id=' . $languages_id);

}
echo '
<script language="javascript">
<!--
document.write(history.go(-1));
//-->
</script>';
}
//jsp:new: frontend admin menu index_products.tpl.php
?>
<div class="adminmenutoplista"><div class="adminmenutoplista_zahlavi"><h2 class="adminH2"><?=CATEGORY_ADMIN?></h2></div>
<br /><a class="admintophref" href="admin/categories.php?cPath=<?=$cPath  . '">' . ADMIN_CURRENT_CATEGORY; ?></a> 
<a class="admintophref" target="_blank" href="/admin/categories.php?cPath=<?= $cPath  . '&action=new_product">' . ADMIN_NEW_PRODUCT_IN_CATEGORY;?></a>


<?
echo '<form action=" '  . $_SERVER['REQUEST_URI'] . '" method="post" enctype="multipart/form-data">';


//vkladame NOVY//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($new=='new') { 
echo '<input type="hidden" name="editmode" value="newproducts">'; //akce vlkadani
echo 'název: <input id="products_name_new" name="products_name_new" cols="20"><br/>';
echo 'zobrazit na HomePage? <input type="checkbox" id="products_hp_trvale_new" name="products_hp_trvale_new" value="1">';
echo 'Koncept?<input type="checkbox" id="products_status_new" name="products_status_new" checked="checked" value="1">';

//popis
echo '<script type="text/javascript" src="/fckeditor/fckeditor.js"></script>
<script>
  window.onload = function()
    {
    var oFCKeditor = new FCKeditor( "products_description_new" ) ;
    oFCKeditor.Height = 300;
    oFCKeditor.Width = 500;
    oFCKeditor.ToolbarSet = \'Basic\' ;
    oFCKeditor.ReplaceTextarea() ;
  }
 </script>
<textarea name="products_description_new" id="products_description_new" style="height:400px"></textarea>';
} else {
echo '<input type="hidden" name="editmode" value="editcategory">'; 
echo '<br /><br />název kategorie: <input id="categories_name" name="categories_name" style="width:400px" value="'.$categories['categories_name'].'"><br/>';
//echo 'Koncept?<input type="checkbox" id="products_status" name="products_status" checked="checked" value="1">';

//popis
echo '<script type="text/javascript" src="/fckeditor/fckeditor.js"></script>
<script>
  window.onload = function()
    {
    var oFCKeditor = new FCKeditor( "categories_description" ) ;
    oFCKeditor.Height = 600;
    oFCKeditor.Width = ' . $articlearea . ';
/*    oFCKeditor.ToolbarSet = \'Basic\' ; */
    oFCKeditor.ReplaceTextarea() ;
  }
 </script>

<textarea name="categories_description" id="categories_description" style="height:400px">' .$cat_descript['categories_description'] . '</textarea>';
}


echo '</form>';

?>

</div>