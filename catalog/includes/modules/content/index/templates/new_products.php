<div class="col2">
<?php
  $info_query = tep_db_query("SELECT products_description FROM products_description WHERE products_name='Homepage' AND language_id=" . $languages_id);
//  $info_query = tep_db_query("SELECT products_description FROM products, products_description WHERE products.products_id=products_description.products_id AND products_description.products_name='Homepage' AND language_id=" . $languages_id);
  $info = tep_db_fetch_array($info_query);
  echo is_array($info) ? $info['products_description'] : '';
?>
</div>
<div class="col2">
  <h2><?php echo sprintf(MODULE_CONTENT_INDEX_NEW_PRODUCTS_BOX_TITLE, (new DateTime())->format('F')); ?></h2>

<div class="row">

    <?php
    foreach ($new_products_array_x as $products) {
        ?>

      <div class="col-3">

        <div class="text-center">
          <a href="<?php echo tep_href_link('product_info.php', 'products_id='.$products['products_id']); ?>"><?php echo tep_image('images/products/thumbs/'.$products['products_image'], $products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'class="img-fluid"'); ?></a>

          <div class="m-2">
            <a href="<?php echo tep_href_link('product_info.php', 'products_id='.$products['products_id']); ?>"><?php echo $products['products_name']; ?></a>
          </div>
          <?php if (defined('DISABLE_PRICES') && constant('DISABLE_PRICES') !== 'true') { ?>
          <?php if( $products['products_price'] !='0Kč') { ?>
          <div class="mb-2">
            <?php echo $products['products_price']; ?>
          </div>
          <?php }
          }

 ?>
        </div>

      </div>

      <?php
    }
  ?>

  </div>
</div>
