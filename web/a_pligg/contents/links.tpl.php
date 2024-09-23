<?php $link_sql="select l.link_title,l.link_url,l.link_description,l.link_found, l.links_image from links l where l.link_state=1 order by l.links_id";

        if ($action = 'catsel' && $cats) $link_sql="select l.link_title,l.link_url,l.link_description,l.link_found, l.links_image from links l where l.link_state=1 and l.category = '" . (int)$cats . "' order by l.links_id"; ?>
<table summary="" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
    <td><h1><?php echo (!$cats ? LM_TITLE : '' . $category_name[$cats] . ' Links');?></h1></td>
  </tr>
  <tr>
    <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '30'); ?></td>
  </tr>
        <tr><td width="100%">
        <?php if ($rows) { ?>
        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
    <td align="right" width="100%" class="smallText"><?php echo tep_draw_form('cat', tep_href_link('links.php', 'action=catsel'), 'get').'Links Category: ' . tep_draw_pull_down_menu('category', $category_array, $cats, 'onchange="this.form.submit();" rel="nofollow"'); //rel="nofollow"
?><noscript><input title="View" name="" type="submit" value="Go" /></noscript></form><p style="margin-bottom:-28px;">&nbsp;</p></td>
  </tr></table>
        <?php } ?>
        </td></tr>
  <tr>
    <td>
<table width="100%"  border="1" cellspacing="2" cellpadding="2" class="boxText">
 <?php                    $link_split=new splitPageResults($link_sql,$result_page,'l.links_id','page');
              $links_query=tep_db_query($link_split->sql_query);
                                                        $i = 0; $pics_array = array();
              while($links_tree=tep_db_fetch_array($links_query)){
                           ?> <tr>
    <td width="130" align="center"><?php echo  '<a ' . ($links_tree['link_found'] ? '' : 'rel="nofollow" ') . 'href="'.$links_tree['link_url'] . '" target="' . $target . '" >';
                         if (!$links_tree['links_image']) {
                                 $pics_array[$i] = 'http://open.thumbshots.org/image.pxf?url=' . $links_tree['link_url'];
                                                        echo tep_image(DIR_WS_IMAGES . 'loading.jpg',$links_tree['link_title'],120,90,'name="pic' . $i . '"');$i++;
                                                        } else {
                                                        echo tep_image(DIR_WS_IMAGES . $links_tree['links_image'],$links_tree['link_title'],'120','90');
//jsp:orig disable links folder                                                       echo tep_image(DIR_WS_IMAGES . 'links/' . $links_tree['links_image'],$links_tree['link_title'],'120','90');
                                                        } ?>
</a></td>
    <td align="center" width="100%"><?php echo  '<a ' . ($links_tree['link_found'] ? '' : 'rel="nofollow" ') . 'href="'.$links_tree['link_url'] . '" target="' . $target . '" ><b>'.$links_tree['link_title'].'</b></a><br /><br />'.nl2br($links_tree['link_description']); ?></td>
  </tr><?php }  //while

        if ($link_split->number_of_rows > $result_page){  ?>
   <tr>
   <td colspan="4"><table summary="" width="100%" >
<tr><td class=boxText >
        <?php  echo $link_split->display_count(TEXT_DISPLAY_NUMBER_OF_LINKS).'</td><td class=boxText  align="right">'.TEXT_RESULT_PAGE . ' ' . $link_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info'))); ?>
        </td></tr>
</table></td>
  </tr>
        <?php } ?>
</table>
<script>
<!--
function ShowPic() {
                                                <?php for( $n=0; $n<$i; $n++ ) {
                                                echo 'pic_image' . $n . '= new Image();   ';
                                                echo 'pic_image' . $n . '.src = "' . $pics_array[$n] . '";  ';
                                                echo 'document.images["pic' . $n . '"].src=pic_image' . $n . '.src;  ';
                                                } ?>

}
// -->
</script>
</td></tr>
<tr>
    <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '40'); ?></td>
  </tr>
<tr>
    <td align="center"><?php echo tep_draw_form('add_link',tep_href_link('links_submit.php',tep_get_all_get_params()),'get');
                //echo tep_image_submit('button_links.gif', MSBUT)?><input type=submit value="<?php echo MSBUT;?>">
                </form></td>
  </tr>
        <tr>
    <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>
  </tr>
<tr>
    <td class="small" align="center"><a href="http://www.thumbshots.com" target="_blank" rel="nofollow" title="This site uses Thumbshots previews">This site uses Thumbshots previews</a></td>
  </tr>
</table>
