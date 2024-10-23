<?php

require 'includes/application_top.php';
require 'includes/template_top.php';
?>

    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
          <td><?php echo PURGED;?>

          </table><?php
require 'includes/template_bottom.php';
require 'includes/application_bottom.php';

chdir('../../bin/');
shell_exec('./cscompile.php');
