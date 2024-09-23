<?//aktuality
exit;
//1) insert
$novakateg = 11;

if ($vstup==1) {
if ($products_status_new!=1) $products_status_new = 0; //else $products_status_new = 0;
    tep_db_query("INSERT into products (products_status, manufacturers_id, products_hp_trvale, products_date_added, products_last_modified) values ('$products_status_new', 1, '$products_hp_trvale_new', NOW(), NOW())");
    $idzaznamu=mysql_insert_id();
    tep_db_query("insert into products_to_categories (products_id, categories_id) values ('$idzaznamu', '$novakateg')");
    tep_db_query("insert into products_description (products_name, products_description, products_url, products_id, language_id)
    values ('$products_name_new',       '$products_description_new',        '',     '$idzaznamu', '7')");

echo '
<script language="javascript">
<!--
document.write(history.go(-1));
//-->
</script>';
}
?>
<div class="adminmenutoplista"><div class="adminmenutoplista_zahlavi">Homepage Admin / Nová Aktualita</div>
<br />
<a class="admintophref" href="admin/categories.php">kategorie</a> <a class="admintophref" href="admin/events_manager.php">Akce</a> <a class="admintophref" href="admin/events_manager.php">vložit akci</a>
<a class="admintophref" href="/admin/polls.php">ankety</a>
<a class="admintophref" href="admin/">Admin nastavení ststému</a> 
<br /><br />
<form action="?vstup=1" method="post" enctype="multipart/form-data">

<?
//vkladame novinku
//nazev
echo 'název článku: <input id="products_name_new" name="products_name_new" cols="20"><br/>';
echo 'zobrazit na HomePage? <input type="checkbox" id="products_hp_trvale_new" name="products_hp_trvale_new" value="1">';
echo 'Publikovat?<input type="checkbox" id="products_status_new" name="products_status_new" checked="checked" value="1">';

//popis
echo '<script type="text/javascript" src="/fckeditor/fckeditor.js"></script>
<script>
  window.onload = function()
    {
    var oFCKeditor = new FCKeditor( "products_description_new" ) ;
/*     oFCKeditor.BasePath = "/fckeditor/" ; */
    oFCKeditor.Height = 600;
    oFCKeditor.Width = 295;
/*    oFCKeditor.ToolbarSet = \'Basic\' ;*/
    oFCKeditor.ReplaceTextarea() ;
  }
 </script>

<br /><textarea name="products_description_new" id="products_description_new" style="height:400px"></textarea>';
?>
</form></div>