<?php /* template for all boxes, edit and "save as" for individual boxes */ ?>
<table style="width:100%;" cellspacing="0" class="infoBoxLT" id="<?php if (isset($box_id)) {echo $box_id . 'LT';} ?>" summary="infoBox">
    <tr><td class="infoBoxHeadingLT"><div><?php echo $boxHeading; ?></div><?php echo $boxLink; ?></td></tr>
    <tr><td class="boxTextLT"><?php echo $boxContent; ?></td></tr>
</table>
