<td><?php echo tep_draw_form('quick_find', tep_href_link('advanced_search_result.php', '', $request_type, false), 'get').tep_draw_hidden_field('search_in_description', '1').tep_hide_session_id(); ?>
    <?php echo tep_draw_input_field('keywords', '', 'size=30 placeholder="'.IMAGE_BUTTON_SEARCH.'"'); ?>

    <button type="submit"><u>ok</u></button>
  </form>
