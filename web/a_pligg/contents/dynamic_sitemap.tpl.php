<h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_specials.png'), HEADING_TITLE); ?>            
  <?php echo HEADING_TITLE; ?>
</h1><br />
<div class="AlignLeft">
  <?php require DIR_WS_CLASSES . 'category_tree.php'; $osC_CategoryTree = new osC_CategoryTree; echo $osC_CategoryTree->buildTree(); ?> <br />
  <ul class="inputRequirement">
  <?php if (count($files['name']) > 0) { 
          for ($b = 0; $b < count($files['name']); ++$b) { 
  ?>               
  <li><?php echo '<a title="'. $files['name'][$b] .'" href="' . tep_href_link($files['path'][$b]) . '">' . $files['name'][$b] . '</a>'; ?></li>
  <?php 
          } 
        }                 
?>
</ul>
</div>