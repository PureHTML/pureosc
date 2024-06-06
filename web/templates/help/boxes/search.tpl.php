<div id="<?php if (isset($box_id)) {echo $box_id;} ?>" class="infoBoxFL" style="background: transparent; border-width: 0;">
  <div class="infoBoxContentsFL" style="margin: auto;"><?php echo $boxContent; ?>
<dl class="explain">
  <dt>CSS</dt>
    <dd>class="infoBoxFL"</dd>
    <dd><?php if (isset($box_id)) {echo 'id="' , $box_id , '"';} ?></dd>
  <dt>Box file</dt>
    <dd><?php echo DIR_WS_INCLUDES , '<br />' ,$box_base_name , '.php'; ?></dd>
  <dt>Box template</dt>
    <dd><strong><?php 
      echo bts_select('boxes'); // BTSv1.5 ?>
    </strong></dd>
</dl>  
    </div> 
</div>

