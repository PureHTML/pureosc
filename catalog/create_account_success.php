<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */

require 'includes/application_top.php';

require 'includes/languages/'.$language.'/create_account_success.php';

$breadcrumb->add(NAVBAR_TITLE_1);
$breadcrumb->add(NAVBAR_TITLE_2);

if (\count($navigation->snapshot) > 0) {
    $origin_href = tep_href_link($navigation->snapshot['page'], tep_array_to_string($navigation->snapshot['get'], [tep_session_name()]), $navigation->snapshot['mode']);
    $navigation->clear_snapshot();
} else {
    $origin_href = tep_href_link('index.php');
}

require 'includes/template_top.php';
?>

  <h1><?php echo HEADING_TITLE; ?></h1>

  <div class="mb-5">
    <p><?php echo TEXT_ACCOUNT_CREATED; ?></p>

    <?php echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'triangle-1-e', $origin_href, 'btn-light'); ?>
  </div>

<?php
require 'includes/template_bottom.php';

require 'includes/application_bottom.php';
