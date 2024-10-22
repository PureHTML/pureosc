<tr>
  <td id=cim><u><?php 
  if (is_array($categories_array)) {
    echo TEXTBROWSER_SUBCATEGORIES;
     } else {
       echo TEXTBROWSER_NO_SUBCATEGORIES;  //TODO: nejede!
     }
  ?></u><ul>
    <?php
    foreach ($categories_array as $categories) {
        ?>

        <li><a href="<?php echo tep_href_link('index.php', $categories['cPath']); ?>"><?php echo tep_image('images/categories/'.$categories['categories_image'], '&nbsp;', SUBCATEGORY_IMAGE_WIDTH, SUBCATEGORY_IMAGE_HEIGHT, 'class="img-fluid"'); ?>
        <?php echo $categories['categories_name']; ?></a>

      <?php
    }

    ?>
</ul>
