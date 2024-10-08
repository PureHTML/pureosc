<div class="mb-3">

    <?php
    if ($product_info['products_quantity'] > (int) \constant('STOCK_REORDER_LEVEL')) {
        $pattern = '/[a-zč $]*/i';
        $replacement = '';

        if (preg_replace($pattern, $replacement, $products_price) !== '0') {
            if (empty($specials_new_products_price)) {
                ?>

            <h2><?php echo $products_price; ?></h2>

            <?php
            } else {
                ?>

            <del class="text-muted"><?php echo $products_price; ?></del>
            <h2 class="text-danger"><?php echo $specials_new_products_price; ?></h2>

            <?php
            }
        }
    }

    ?>

</div>
