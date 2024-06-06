Hy!
Sorry for my bad english, and the so simply code.

This "contrib" allows you to attach heading images to the articles listing.
No image size restrictions.

Installation time aprox: 20 sec.

The code:
open article_listing.php
on line 67 find:
------------------------------------------------------------------
<?php
      if (DISPLAY_ABSTRACT_ARTICLE_LISTING == 'true') {
?>
          <tr>
            <td class="main" style="padding-left:15px"><?php echo clean_html_comments(substr($articles_listing['articles_head_desc_tag'],0, MAX_ARTICLE_ABSTRACT_LENGTH)) . ((strlen($articles_listing['articles_head_desc_tag']) >= MAX_ARTICLE_ABSTRACT_LENGTH) ? '...' : ''); ?></td>
          </tr>

------------------------------------------------------------------
replace with:

<?php
      if (DISPLAY_ABSTRACT_ARTICLE_LISTING == 'true') {
?>
          <tr>
            <td>
<table>

<tr>
<td style="padding-left:5px" valign="top">
<img src="/images/magazin-<?php echo $articles_listing['articles_id']; ?>.jpg" alt="<?php echo $articles_listing['articles_name']; ?>" title="<?php echo $articles_listing['articles_name']; ?>">
</td>
<td class="main" style="padding-left:15px" valign="top">
<?php echo clean_html_comments(substr($articles_listing['articles_head_desc_tag'],0, MAX_ARTICLE_ABSTRACT_LENGTH)) . ((strlen($articles_listing['articles_head_desc_tag']) >= MAX_ARTICLE_ABSTRACT_LENGTH) ? '...' : ''); ?>
<br><br><font size="-3"><b>
<?php echo TEXT_DATE_ADDED . ' ' . tep_date_long($articles_listing['articles_date_added']); ?>
</td>
</tr>
<tr><td class="smalltext">
<?php echo tep_draw_separator('pixel_tr.gif', '100%', '5'); ?>
</td></tr>
</table>
</tr>

That is all.
Image names, direcory:
The following line may be change to control image names: 
<img src="/images/magazin-<?php echo $articles_listing['articles_id']; ?>.jpg">

so the image file will be: magazin-1.jpg, magazin-2. jpg, etc. 

Only 1 file uploaded, please backup before install.

working demo: <a href="http://www.anrodiszlec.hu/articles.php/tPath/1">http://www.anrodiszlec.hu/articles.php/tPath/1</a>