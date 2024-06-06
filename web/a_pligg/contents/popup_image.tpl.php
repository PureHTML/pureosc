<h1 class="pageHeading"><?php echo TEXT_LIST_ENLARGE . $products_oswai['products_name']; ?></h1>  
  
<div class="Venticinque2">
<?php
    if (tep_not_null($product_info['products_image'])) {
?>

<?php echo '<a href="' . tep_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $product_info['products_id'] . SEPARATOR_LINK . 'multi_images=products_image0') . '">' . tep_image(DIR_WS_IMAGES . $product_info['products_image'], addslashes($product_info['products_name']), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, '') . '<br />' . TEXT_CLICK_TO_ENLARGE . '</a><br /><br />'; ?>

<?php
    }
?>
<?php
//060417/zepitt/multi images extra
/// MULTI IMAGE
	for($nb=1; $nb <= NB_IMAGE_EXTRA ; $nb++) {
		$var_products_image = "products_image".$nb;
		if (tep_not_null($product_img[$var_products_image])) {
		?>        
		<?php echo '<a href="' . tep_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $product_info['products_id'] . SEPARATOR_LINK . 'multi_images=' . $var_products_image) . '">' . tep_image(DIR_WS_IMAGES . "images_extra/" . $product_img[$var_products_image], addslashes($product_info['products_name']), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, '') . '<br />' . TEXT_CLICK_TO_ENLARGE . '</a><br /><br />'; ?>
		<?php
	    }
    }
//060417/zepitt/multi images extra EOF
?>
</div>

<?php 
if (TEMPLATE_WATERMARK == 'true') {
  require(DIR_WS_CLASSES . 'img.class.php');
  $img_watermark_oswai = new img;
  //variabili settabili (valori segnati default)
  $img_watermark_oswai->name = ""; //nome immagine senza estensione, di default preso nome originale
  if (TEMPLATE_WATERMARK_DIM == '320x240') {
    $img_watermark_oswai->max_w = 320; // larghezza max in px
    $img_watermark_oswai->max_h = 240; // altezza max in px
  } elseif (TEMPLATE_WATERMARK_DIM == '640x480')  {
    $img_watermark_oswai->max_w = 640; // larghezza max in px
    $img_watermark_oswai->max_h = 480; // altezza max in px
  } elseif (TEMPLATE_WATERMARK_DIM == '800x600') {
    $img_watermark_oswai->max_w = 800; // larghezza max in px
    $img_watermark_oswai->max_h = 600; // altezza max in px
  } elseif (TEMPLATE_WATERMARK_DIM == '1024x768') {
    $img_watermark_oswai->max_w = 1024; // larghezza max in px
    $img_watermark_oswai->max_h = 768; // altezza max in px
  }
  $img_watermark_oswai->pos_x = "RIGHT"; // posizione logo -> RIGHT, LEFT, CENTER
  $img_watermark_oswai->pos_y = "BOTTOM"; // posizione logo -> BOTTOM, TOP, MIDDLE
  $img_watermark_oswai->img_folder = ""; // cartella immagine grande (default-> cartella dell'immagine originale)
  $img_watermark_oswai->saveTHUMB = 0; //salvare thumb -> 1 o 0
  $img_watermark_oswai->saveBIG = 1; //salvare immagine grande 1 o 0

  if (isset($_GET['multi_images']) && ($_GET['multi_images'] != 'products_image0')) {
    $img_original = DIR_WS_IMAGES . "images_extra/" . $product_img[$_GET['multi_images']];
  } else {
    $img_original = DIR_WS_IMAGES . $products_oswai['products_image'];
  }

  $img_original_type = strtolower(substr($img_original, strrpos($img_original, "."), strlen($img_original)-strrpos($img_original, ".")));
  $img_watermark_oswai_logo = bts_select(images, 'logo_watermark.png');
  $img_watermark_oswai->AddLogo($img_original, $img_watermark_oswai_logo);
  $img_visualizzata = str_replace($img_original_type, '_watermark.png', $img_original);
  echo tep_image($img_visualizzata , $products_oswai['products_name']);
} else {
  if (isset($_GET['multi_images']) && ($_GET['multi_images'] != 'products_image0')) {
    echo tep_image(DIR_WS_IMAGES . "images_extra/" . $product_img[$_GET['multi_images']], $products_oswai['products_name']);  
  } else {
    echo tep_image(DIR_WS_IMAGES . $products_oswai['products_image'], $products_oswai['products_name']);
  }
}
?>
  
  <br class="Clear" /> <br />
<div class="CinquantaL">
    <?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $product_info['products_id']) . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; ?>
</div>
