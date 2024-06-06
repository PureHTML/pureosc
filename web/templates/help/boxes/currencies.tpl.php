<div id="<?php if (isset($box_id)) {echo $box_id;} ?>" class="infoBoxFL" style="position:absolute; top: -90px; right: 150px; white-space: nowrap; width: 300px; text-align: center; background: transparent; border-width: 0;">
  <div class="explain" style="color: black; font-weight: normal;"><strong><?php 
    echo bts_select('boxes'); // BTSv1.5 ?></strong>
  </div>
  <div class="infoBoxContentsFL" style="margin: auto;"><?php echo $boxContent; ?></div>
</div>

