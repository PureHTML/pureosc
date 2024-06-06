<?php echo tep_draw_form('account_newsletter', tep_href_link(FILENAME_ACCOUNT_NEWSLETTERS, '', 'SSL')) . tep_draw_hidden_field('action', 'process'); ?>
<h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_account.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo HEADING_TITLE; ?>
</h1> <br />
  <h2 class="b"><?php echo MY_NEWSLETTERS_TITLE; ?></h2>
  <div class="InfoBoxContenent2MA">
    <p class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="checkBox('newsletter_general')">
       <br /> <span class="b">
       <?php echo tep_draw_checkbox_field_label(MY_NEWSLETTERS_GENERAL_NEWSLETTER, 'newsletter', 'newsletter_general', '1', (($newsletter['customers_newsletter'] == '1') ? true : false), 'onclick="checkBox(\'newsletter_general\')"'); ?> <br />
       </span> <br />
    </p>
       <?php echo MY_NEWSLETTERS_GENERAL_NEWSLETTER_DESCRIPTION; ?>
  </div> <br />
  
<div class="CinquantaL">
    <?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; ?>
</div>

<div class="CinquantaR">
    <?php echo tep_image_submit('button_continue.png', IMAGE_BUTTON_CONTINUE, 'id="continue"'); ?>
</div>

  </form>