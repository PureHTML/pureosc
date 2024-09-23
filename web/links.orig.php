<?php
/*
  $Id: links.php 3.3 2009-01-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
  $new_page = false; // set to true to open links in a new page
        $result_page = 10; //results per page

  require('includes/application_top.php');
  if ($_GET['page'] == 1) {unset($_GET['page']); tep_redirect(tep_href_link('links.php')); }
        if (isset($_GET['category']) && $_GET['category'] == 0) {unset($_GET['category']); tep_redirect(tep_href_link('links.php')); }  //prevent duplicates on google
  require(DIR_WS_LANGUAGES . $language . '/links.php');
  //require(DIR_WS_FUNCTIONS.'pagerank.php');
        $action = (isset($_GET['action']) ? $_GET['action'] : '');
        $units = array( 1 =>"One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine" );
// changed by http://www.sportzone4you.de
//        $target = ($new_page ? '_blank' : '_parent');
// changed by http://www.sportzone4you.de
 $target = ($new_page ? '_blank' : '_blank');
        //category drop-down
  $category_array = array();
        $category_array[0] = array('id' => '0', 'text' => 'All');
        $category_query = tep_db_query("select category_id, category_name from links_categories where status = 1 order by sort_order, category_name");
  $rows = tep_db_num_rows($category_query);
        $page = $_GET['page'] > 0 ? $_GET['page'] : false;
        $cats = ($_GET['category'] > 0 ? $_GET['category'] : false);
  while ($category_values = tep_db_fetch_array($category_query)) {
    $category_array[] = array('id' => $category_values['category_id'], 'text' => $category_values['category_name']);
                $category_name[$category_values['category_id']] = $category_values['category_name'];
  }
        $product_info = TITLE . ' Links ' . (!$page ? '' : 'Page ' . $units[$page]) . (!$cats ? '' : '- ' .$category_name[$cats]);
  $breadcrumb->add('links', tep_href_link('links.php'));

        //$exclude = array(); if (!in_array('test', $exclude)) echo 'notin';
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
<title><?php echo TITLE . ' Links ' .(!$page ? 'Page' : 'Page ' . $units[$page]). ' - ' .  (!$cats ? (!$page  ? '' : $category_name[$category_array[$page]['id']]) : $category_name[$cats] . ' Links') . (!$page ? ' ' : '');  ?> </title>
    <meta name="Description" content="Links <?php echo (!$page ? '' : 'Page ' . $units[$page]) . ' - '. TITLE .' - ' .  (!$cats ? (!$page ? '' : $category_name[$category_array[$page]['id']]) : $category_name[$cats]); ?> - " />
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>" />

    <meta name="KeyWords" content="" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="Copyright" content="" />
    <meta http-equiv="Content-Language" content="en" />
    <meta name="revisit-after" content="30 days" />
    <meta name="robots" content="index, follow" />
    <meta name="Rating" content="General" />
    <meta name="Robots" content="All" />
<link rel="canonical" href="<?php echo tep_href_link('links.php', ($page ? 'page=' . $page : ''),'NONSSL',false); ?>" />
<link rel="stylesheet" type="text/css" href="stylesheet.css" />

</head>
<body onload="ShowPic();"> <!-- post load thumbnails -->
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="3" cellpadding="3">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>

    <td width="100%" align="center" valign="top">

<!-- body_text //-->
<?php $link_sql="select l.link_title,l.link_url,l.link_description,l.link_found, l.links_image from links l where l.link_state=1 order by l.links_id";

        if ($action = 'catsel' && $cats) $link_sql="select l.link_title,l.link_url,l.link_description,l.link_found, l.links_image from links l where l.link_state=1 and l.category = '" . (int)$cats . "' order by l.links_id"; ?>
<table summary="" width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:60px;">
    <tr>
    <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
  </tr>
        <tr>
    <td align="center" class="pageHeading"><?php echo (!$cats ? LM_TITLE : '' . $category_name[$cats] . ' Links');?></td>
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
                                                        echo tep_image(DIR_WS_IMAGES . 'links/' . $links_tree['links_image'],$links_tree['link_title'],'120','90');
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

<!-- body_text_eof //-->

        </td>
<!-- body_text_eof //-->
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- right_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_right.php'); ?>
<!-- right_navigation_eof //-->
    </table></td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br />

</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>