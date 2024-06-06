<?php /* infobox template  */ ?>

    <?php 
    /*
    switch ($corner_left) { 
    case 'square': echo '';
    break; 
    case 'rounded': echo ''; 
    break;
    } 
    switch ($corner_right) { 
    case 'square': echo '';
    break; 
    case 'rounded': echo ''; 
    break;
    }
    */
     ?>
<? 
//shop2.0brain: new special cases switch
if($box_base_name != 'manufacturers') { ?>
<div class="BoxesInfoBoxHeadingCenterBoxTitle"> 
    <?php 
    /*
    switch ($corner_left) { 
    case 'square': echo '';
    break; 
    }
    */
echo $boxLink . $boxHeading; ?></div>
<? } ?>

<div class="InfoBoxContenent2MABox">
<?php // echo $boxContent_attributes;
?>
<?php echo $boxContent; ?>
</div>
<br />