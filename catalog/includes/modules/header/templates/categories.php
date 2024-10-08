<nav id=nav>
  <ul>
     <?php
        if ($special_products) {
            ?>
          <li>
            <a class="nav-link text-danger fw-bold" href="<?php echo tep_href_link('specials.php'); ?>"><?php echo MODULE_HEADER_CATEGORIES_TEXT_SALE; ?></a>
          <?php
        }
    ?>
  <?php echo $categories_list; ?>
  </ul>
</nav>
