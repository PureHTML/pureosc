<div class="flc">
  <h2><?php echo sprintf(MODULE_CONTENT_INDEX_NEW_PRODUCTS_BOX_TITLE, (new DateTime())->format('F')); ?></h2>



    <?php
    foreach ($new_products_array_x as $products) {
        ?>

          <a href="<?php echo tep_href_link('product_info.php', 'products_id='.$products['products_id']); ?>"><?php echo tep_image('images/products/thumbs/'.$products['products_image'], $products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, ''); ?></a>


            <a href="<?php echo tep_href_link('product_info.php', 'products_id='.$products['products_id']); ?>"><?php echo $products['products_name']; ?></a>

          <?php if (\defined('DISABLE_PRICES') && \constant('DISABLE_PRICES') !== 'true') { ?>
          <?php if ($products['products_price'] !== '0Kč') { ?>

            <?php echo '<br>' . $products['products_price']; ?>

          <?php }
          }

        ?>




      <?php
    }

?>
</div>
