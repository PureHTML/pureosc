<?
exit;
$articlearea = 586;
echo '<div style="z-index:1000;position:absolute;left:800px;top:-98px;width:295px;background:#fff;text-align:left;"><div style="width:100%;background:#8a7467;color:white;text-align:center;height:18px;padding-top:3px">Nová Aktualita</div>
<a href="admin/">Admin</a><br />';
echo '<form action=" '  . $_SERVER['REQUEST_URI'] . '" method="post" enctype="multipart/form-data">';


//vkladame NOVY//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($new=='new') { 
echo '<input type="hidden" name="editmode" value="newproducts">'; //akce vlkadani
echo 'název: <input id="products_name_new" name="products_name_new" cols="20"><br/>';
echo 'zobrazit na HomePage? <input type="checkbox" id="products_hp_trvale_new" name="products_hp_trvale_new" value="1">';
echo 'Koncept?<input type="checkbox" id="products_status_new" name="products_status_new" checked="checked" value="1">';

//popis
echo '<script type="text/javascript" src="/fckeditor/fckeditor.js"></script>
<script type="text/javascript">
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
echo '<input type="hidden" name="editmode" value="editproducts">'; 
echo 'název: <input id="products_name" name="products_name" cols="20" value="' . $product_info['products_name'] . '"><br/>';
echo 'zobrazit na HomePage? <input type="checkbox" id="products_hp_trvale" name="products_hp_trvale" value="1">';
echo 'Publikovat?<input type="checkbox" id="products_status" name="products_status" checked="checked" value="1">';

//popis
echo '<script type="text/javascript" src="/fckeditor/fckeditor.js"></script>
<script type="text/javascript">
  window.onload = function()
    {
    var oFCKeditor = new FCKeditor( "products_description" ) ;
    oFCKeditor.Height = 600;
    oFCKeditor.Width = ' . $articlearea . ';
    oFCKeditor.ToolbarSet = \'Basic\' ;
    oFCKeditor.ReplaceTextarea() ;
  }
 </script>

<textarea name="products_description" id="products_description" style="height:400px">' .$product_info['products_description'] . '</textarea>';
}


echo '</form></div>';
?>